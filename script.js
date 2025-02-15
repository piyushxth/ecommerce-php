const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

//show sidebar
menuBtn.addEventListener("click", () => {
  sideMenu.style.display = "block";
});

//close sidebar
closeBtn.addEventListener("click", () => {
  sideMenu.style.display = "none";
});

//change theme

document.addEventListener("DOMContentLoaded", function () {
  const themeToggleButton = document.getElementById("theme-toggle-button");
  const body = document.body;

  // Function to set the theme based on the user's preference
  function setTheme(theme) {
    if (theme === "dark") {
      body.classList.add("dark-theme-variables");
      themeToggleButton.classList.add("active");
    } else {
      body.classList.remove("dark-theme-variables");
      themeToggleButton.classList.remove("active");
    }
  }

  // Function to toggle the theme and save the preference to Local Storage
  function toggleTheme() {
    if (body.classList.contains("dark-theme-variables")) {
      setTheme("light");
      localStorage.setItem("theme", "light");
    } else {
      setTheme("dark");
      localStorage.setItem("theme", "dark");
    }
  }

  // Check if the theme preference is stored in Local Storage
  const savedTheme = localStorage.getItem("theme");

  // Set the theme based on the saved preference or default to light
  if (savedTheme) {
    setTheme(savedTheme);
  } else {
    setTheme("light");
  }

  // Add click event listener to the theme toggle button
  themeToggleButton.addEventListener("click", toggleTheme);
});
