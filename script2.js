document.addEventListener("DOMContentLoaded", function () {
  const profilePhoto = document.querySelector(".profile-photo");
  const profile = document.querySelector("#profile");

  profilePhoto.addEventListener("click", function (event) {
    profile.classList.toggle("active");
    event.stopPropagation(); // Prevent the scroll event from immediately closing it
  });

  // To close the profile when clicking outside of it
  document.addEventListener("click", function (event) {
    if (
      !event.target.closest(".profile-photo") &&
      !event.target.closest("#profile")
    ) {
      profile.classList.remove("active");
    }
  });

  // To close the profile when scrolling the window
  window.addEventListener("scroll", function () {
    profile.classList.remove("active");
  });
});
