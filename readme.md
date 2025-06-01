# Video Archiver

A simple way to watch your favorite videos offline — no internet required!

Built with PHP. Designed for simplicity.

## Description

Video Archiver lets you download and watch YouTube videos locally using yt-dlp and PHP.  
Perfect for curating your own offline video library.

## Requirements

- A server or local environment that can run PHP scripts (e.g., XAMPP, WAMP, LAMP)
- FFmpeg in your system PATH
- Git (optional, for updates)

## Windows Installation

1. Download the latest release as ZIP:  
   [Download ZIP from GitHub](https://github.com/DotRYOT/videoArchiver/archive/refs/heads/main.zip)

2. Install FFmpeg (if not already installed):

```
winget install "FFmpeg (Essentials Build)"
```

3. Extract the ZIP into your web root directory (e.g., `htdocs` if using XAMPP).

4. Open your browser and go to:
   http://localhost/videoArchiver/index.php

5. The app will automatically install `yt-dlp` on first launch.

## Auto-Updater

The app includes a built-in updater so you won't need to manually re-download it every time. But you can always come back to look at the code or updates.

## Roadmap

- Setup and basic functionality (complete)
- Fix filters (complete)
- Finish settings page (in progress)

## Authors

- [@DotRYOT](https://github.com/DotRYOT)

## Tech Stack

- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Server: Apache (or compatible environment)
- Dependencies: [yt-dlp](https://github.com/yt-dlp/yt-dlp), FFmpeg

## License

This project is licensed under the [MIT License](https://github.com/DotRYOT/videoArchiver/blob/main/LICENSE).
