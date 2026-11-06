<?php

class ZipHandler
{
    private ?string $zipPath = null;
    private ?ZipArchive $zip = null;
    
    public int $filecount = 0;
    public array $filelist = [];

    /**
     * Constructor initializes with a zip file path.
     * If the path does not exist, it logs an error and sets internal state to null.
     */
    public function __construct(string $zipPath)
    {
        $this->zipPath = $zipPath;
        
        if (!file_exists($zipPath)) {
            $this->logError("Initialization failed: The file path '{$zipPath}' does not exist.");
            $this->zip = null;
            return;
        }

        $this->zip = new ZipArchive();
        $res = $this->zip->open($this->zipPath);

        if ($res !== TRUE) {
            $this->logError("Initialization failed: Could not open zip archive '{$zipPath}'. Error code: {$res}");
            $this->zip = null;
            return;
        }

        $this->loadArchiveDetails();
    }

    /**
     * Populates filecount and filelist from the opened archive.
     */
    private function loadArchiveDetails(): void
    {
        $this->filecount = $this->zip->numFiles;
        $this->filelist = [];

        for ($i = 0; $i < $this->filecount; $i++) {
            $stat = $this->zip->statIndex($i);
            if ($stat && !str_ends_with($stat['name'], '/')) {
                // Store relative paths of files (excluding directory entries)
                $this->filelist[] = $stat['name'];
            }
        }
    }

    /**
     * Saves a specific file from the archive to a destination path.
     * 
     * @param string      $relativePath The file path inside the archive (from filelist)
     * @param string|null $savePath     The destination directory or full path (defaults to current dir)
     * @param string|null $password     Optional password for encrypted archives
     */
    public function savetopath(string $relativePath, ?string $savePath = null, ?string $password = null): bool
    {
        if ($this->zip === null) {
            $this->logError("Extraction failed: Zip archive is not initialized.");
            return false;
        }

        if ($password !== null) {
            $this->zip->setPassword($password);
        }

        // Determine destination file path
        if ($savePath === null || $savePath === '') {
            $destination = basename($relativePath);
        } elseif (is_dir($savePath)) {
            // If savePath is a directory, append the basename of the file
            $destination = rtrim($savePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . basename($relativePath);
        } else {
            // Treat savePath as the exact target file path
            $destination = $savePath;
        }

        // Ensure target directory exists
        $dir = dirname($destination);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        // Read file contents from archive
        $content = $this->zip->getFromName($relativePath);
        if ($content === false) {
            $this->logError("Extraction failed: File '{$relativePath}' not found in archive or incorrect password.");
            return false;
        }

        return file_put_contents($destination, $content) !== false;
    }

    /**
     * Adds a file from the filesystem into the zip archive.
     * 
     * @param string      $filePath     Path to the file on disk to add
     * @param string|null $localName    Optional custom relative path name inside the zip
     * @param string|null $password     Optional password for encryption
     */
    public function addfrompath(string $filePath, ?string $localName = null, ?string $password = null): bool
    {
        if ($this->zip === null) {
            // If the zip didn't exist during construction, we can try to create it now
            $this->zip = new ZipArchive();
            $res = $this->zip->open($this->zipPath, ZipArchive::CREATE);
            if ($res !== TRUE) {
                $this->logError("Add failed: Could not create/open zip archive '{$this->zipPath}'.");
                return false;
            }
        }

        if (!file_exists($filePath)) {
            $this->logError("Add failed: Source file '{$filePath}' does not exist.");
            return false;
        }

        $entryName = $localName ?? basename($filePath);

        $success = $this->zip->addFile($filePath, $entryName);

        if ($success && $password !== null) {
            $this->zip->setEncryptionName($entryName, ZipArchive::EM_AES_256, $password);
        }

        // Close and reopen to commit changes and refresh details
        $this->zip->close();
        $this->zip->open($this->zipPath);
        $this->loadArchiveDetails();

        return $success;
    }

    /**
     * Simple internal error logger.
     */
    private function logError(string $message): void
    {
        error_log("[" . date('Y-m-d H:i:s') . "] ZipHandler Error: " . $message);
    }

    /**
     * Destructor to ensure the ZipArchive resource is closed properly.
     */
    public function __destruct()
    {
        if ($this->zip instanceof ZipArchive) {
            $this->zip->close();
        }
    }
}

// 1. Initialize the class (handles missing files gracefully and logs error)
$zipHandler = new ZipHandler('path/to/archive.zip');

// Check if initialization was successful (zip instance/path valid)
// If file didn't exist, filecount will be 0 and operations will log errors.

// 2. View file list and count
echo "Total files: " . $zipHandler->filecount . "\n";
print_r($zipHandler->filelist);

// 3. Save a file from the archive to the current directory
$zipHandler->savetopath('folder/subfolder/image.png', null, 'optional_password');

// 4. Save a file to a specific path
$zipHandler->savetopath('docs/report.pdf', '/var/www/uploads/report.pdf');

// 5. Add a new file from disk into the archive with optional password
$zipHandler->addfrompath('local_notes.txt', 'backup/notes.txt', 'optional_password');
