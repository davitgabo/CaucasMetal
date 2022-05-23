function dropdownToggle(id) {
  let element = document.getElementById(id);
  element.classList.toggle("hide");
}

function hide(id) {
  let element = document.getElementById(id);
  element.style.display = "none";
}

function addInputField(id) {
  let addCategory = document.getElementById(id)
  let inputAdd = document.getElementById('price');
  let inputFieldGeo = document.createElement('input');
  let inputFieldEng = document.createElement('input');
  inputFieldGeo.classList.add('category-input-text');
  inputFieldGeo.type = 'text';
  inputFieldGeo.name = 'subCategory[]';
  inputFieldGeo.autocomplete = 'off';
  inputFieldGeo.placeholder = 'ველი';
  inputFieldEng.classList.add('category-input-text');
  inputFieldEng.type = 'text';
  inputFieldEng.name = 'subCategory[]';
  inputFieldEng.autocomplete = 'off';
  inputFieldEng.placeholder = 'field';
  addCategory.insertBefore(inputFieldGeo, inputAdd);
  addCategory.insertBefore(inputFieldEng, inputAdd);
}

// input type file
let file = document.querySelector("#file");
file.addEventListener("change", (e) => {
  // Get the selected file
  const [file] = e.target.files;
  // Get the file name and size
  const { name: fileName, size } = file;
  // Convert size in bytes to kilo bytes
  const fileSize = (size / 1000).toFixed(2);
  // Set the text content
  const fileNameAndSize = `${fileName} - ${fileSize}KB`;
  document.querySelector(".upload-category-image-label").textContent =
    fileNameAndSize;
  document.getElementById("image-preview").src = URL.createObjectURL(file);
});

// confirm remove category
function confirmRemove(Name, url){
  let remove = confirm("დარწმუნებული ხარ რომ გსურს " + Name + "-ს წაშლა?");
  if (remove){
    location.href = url;
  } else {
    return 0;
  }
}
