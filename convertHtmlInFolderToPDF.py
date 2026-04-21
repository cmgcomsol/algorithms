import os
import pdfkit

locale.setlocale(locale.LC_ALL, '')

path_wkhtmltopdf = r'C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe'
config = pdfkit.configuration(wkhtmltopdf=path_wkhtmltopdf)


def convertHtmlInFolderToPDF(folder):
	for root, dirs, files in os.walk(folder):
		for file in files:
			if file.endswith(".html"):
				input_path = os.path.join(root, file)
				output_path = os.path.join(root, file.replace(".html", ".pdf"))

				# Configuration options
				options = {
					'page-size': 'A4',
					'encoding': "UTF-8",
					'zoom': '0.85',  # 75% Scale
					'enable-local-file-access': None,  # CRITICAL: Allows loading header.png
					'quiet': '',
					'load-error-handling': 'ignore',  # Prevents crashing if an image is missing
					'margin-top': '0.25in',
					'margin-right': '0.25in',
					'margin-bottom': '0.25in',
					'margin-left': '0.25in',
				}

				print(f"Converting: {input_path}")
				try:
					pdfkit.from_file(input_path, output_path, options=options, configuration=config)
				except Exception as e:
					print(f"Failed to convert {file}: {e}")
