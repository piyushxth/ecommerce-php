console.log("hello");
//Funtion to close the div in responsive
bar = document.getElementById("bar");
close = document.getElementById("close");
nav = document.getElementById("navbar");
if (bar) {
  bar.addEventListener("click", () => {
    nav.classList.add("active");
  });
}

if (close) {
  close.addEventListener("click", () => {
    nav.classList.remove("active");
  });
}

//profile active and hide
document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelector("#user-btn")
    .addEventListener("click", function (event) {
      const profile = document.querySelector("#profile");
      profile.classList.toggle("active");
      event.stopPropagation(); // Prevent the scroll event from immediately closing it
    });

  // To close the profile when clicking outside of it
  document.addEventListener("click", function (event) {
    const profile = document.querySelector("#profile");
    if (
      !event.target.closest("#user-btn") &&
      !event.target.closest("#profile")
    ) {
      profile.classList.remove("active");
    }
  });

  // To close the profile when scrolling the window
  window.addEventListener("scroll", function () {
    const profile = document.querySelector("#profile");
    profile.classList.remove("active");
  });
});
