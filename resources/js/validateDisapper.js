const validate = document.getElementById("validateDisapper");
validate
    ? setTimeout(() => {
          validate.style.display = "none";
      }, 5000)
    : "";
