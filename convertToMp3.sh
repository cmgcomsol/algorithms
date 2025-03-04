for entry in ./*
do
	echo "$entry"
	if [[ $entry == *".webm"* ]]; then
		echo "A webm file!!! "
		ffmpeg -hide_banner -loglevel error -n -i "$entry" "${entry/webm/mp3}"
	fi
done
