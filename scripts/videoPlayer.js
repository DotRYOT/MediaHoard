document.addEventListener("DOMContentLoaded", () => {
  const video = document.querySelector("video");
  const playButton = document.getElementById("play-pause");
  const progressBar = document.querySelector(".progress-bar");
  const volumeButton = document.getElementById("volume");
  const fullscreenButton = document.getElementById("fullscreen");
  const volumeControl = document.querySelector(".volume-control");
  const volumeSlider = document.querySelector(".volume-slider input");
  let previousVolume = parseFloat(localStorage.getItem("previousVolume")) || 1;
  let hideCursorTimeout;
  let hideControlsTimeout;

  // Load saved volume
  const savedVolume = parseFloat(localStorage.getItem("volume")) || 1;
  video.volume = savedVolume;
  volumeSlider.value = savedVolume;
  updateVolumeIcon(video.volume);

  video.addEventListener("volumechange", () => {
    localStorage.setItem("volume", video.volume);
  });

  // Play/Pause functionality
  playButton.addEventListener("click", togglePlayPause);
  video.addEventListener("click", togglePlayPause);

  function togglePlayPause() {
    if (video.paused) {
      video.play();
      playButton.innerHTML = '<ion-icon name="pause"></ion-icon>';
    } else {
      video.pause();
      playButton.innerHTML = '<ion-icon name="play"></ion-icon>';
    }
  }

  // Progress bar
  video.addEventListener("timeupdate", () => {
    const progress = (video.currentTime / video.duration) * 100;
    progressBar.style.setProperty("--progress", `${progress}%`);
  });

  progressBar.addEventListener("click", (e) => {
    const rect = progressBar.getBoundingClientRect();
    const pos = (e.clientX - rect.left) / rect.width;
    video.currentTime = pos * video.duration;
  });

  // Volume controls
  volumeButton.addEventListener("click", () => {
    if (video.volume > 0) {
      previousVolume = video.volume;
      localStorage.setItem("previousVolume", previousVolume);
      video.volume = 0;
    } else {
      video.volume = previousVolume;
    }
    showVolumeSlider();
  });

  volumeSlider.addEventListener("input", (e) => {
    const volume = parseFloat(e.target.value);
    video.volume = volume;
    updateVolumeIcon(volume);
    showVolumeSlider();
  });

  function updateVolumeIcon(volume) {
    if (volume === 0) {
      volumeButton.innerHTML = '<ion-icon name="volume-mute"></ion-icon>';
    } else if (volume < 0.5) {
      volumeButton.innerHTML = '<ion-icon name="volume-low"></ion-icon>';
    } else {
      volumeButton.innerHTML = '<ion-icon name="volume-high"></ion-icon>';
    }
  }

  function showVolumeSlider() {
    volumeControl.classList.add("visible");
    clearTimeout(volumeControl.hideTimeout);
    volumeControl.hideTimeout = setTimeout(() => {
      volumeControl.classList.remove("visible");
    }, 3000);
  }

  // Cursor & Controls visibility logic
  const wrapper = document.querySelector(".video-wrapper");
  const controls = wrapper.querySelector(".controls");

  function resetCursorAndControls() {
    // Show cursor
    wrapper.classList.add("show-cursor");

    // Show controls
    controls.style.opacity = "1";
    controls.style.transform = "translateY(0)";

    // Clear timeouts
    clearTimeout(hideCursorTimeout);
    clearTimeout(hideControlsTimeout);

    // Schedule hiding after inactivity
    hideCursorTimeout = setTimeout(() => {
      wrapper.classList.remove("show-cursor");
    }, 2000);

    hideControlsTimeout = setTimeout(() => {
      controls.style.opacity = "0";
      controls.style.transform = "translateY(10px)";
    }, 2000);
  }

  // Mouse move -> show cursor and controls
  wrapper.addEventListener("mousemove", () => {
    resetCursorAndControls();
  });

  wrapper.addEventListener("click", () => {
    resetCursorAndControls();
  });

  wrapper.addEventListener("mouseleave", () => {
    clearTimeout(hideCursorTimeout);
    clearTimeout(hideControlsTimeout);
  });

  // Keep controls visible while hovering over them
  controls.addEventListener("mouseenter", () => {
    clearTimeout(hideCursorTimeout);
    clearTimeout(hideControlsTimeout);
  });

  controls.addEventListener("mouseleave", () => {
    resetCursorAndControls();
  });

  // Fullscreen handling
  fullscreenButton.addEventListener("click", toggleFullscreen);

  function toggleFullscreen() {
    const elem = document.documentElement;
    if (!document.fullscreenElement) {
      elem.requestFullscreen().catch(console.error);
      document.body.classList.add("fullscreen");
    } else {
      document.exitFullscreen().catch(console.error);
      document.body.classList.remove("fullscreen");
    }
  }

  // Exit fullscreen with ESC key
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && document.fullscreenElement) {
      document.exitFullscreen();
      document.body.classList.remove("fullscreen");
    }
  });

  // Optional: Listen for system fullscreen change events
  document.addEventListener("fullscreenchange", () => {
    if (!document.fullscreenElement) {
      document.body.classList.remove("fullscreen");
    }
  });

  // Double click to toggle fullscreen
  wrapper.addEventListener("dblclick", () => {
    if (!document.fullscreenElement) {
      wrapper.requestFullscreen().catch(console.error);
      document.body.classList.add("fullscreen");
    } else {
      document.exitFullscreen().catch(console.error);
      document.body.classList.remove("fullscreen");
    }
  });
});
