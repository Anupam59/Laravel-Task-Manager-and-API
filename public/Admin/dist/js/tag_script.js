const ul = document.querySelector("#ulId"),
    input = document.querySelector("#inputId"),
    tagNumb = document.querySelector("#detailsItem"),
    removeBtn = document.querySelector("#removeBtn"),
    showTagId = document.querySelector("#showTagId");
let maxTags = 10, tags = [];


showArrayCreate();
countTags();
createTag();
showArray();


function countTags() {
    input.focus();
    tagNumb.innerText = maxTags - tags.length;
    showArray();
}

function createTag() {
    ul.querySelectorAll("li").forEach(li => li.remove());
    tags.slice().reverse().forEach(tag => {
        let liTag = `<li>${tag} <i class="fa fa-times" onclick="remove(this, '${tag}')"></i></li>`;
        ul.insertAdjacentHTML("afterbegin", liTag);
    });
    countTags();
}

function remove(element, tag) {
    let index = tags.indexOf(tag);
    tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
    element.parentElement.remove();
    countTags();
}

function addTag(e) {
    if (e.key == "Enter") {
        let tag = e.target.value.replace(/\s+/g, ' ');
        if (tag.length > 1 && !tags.includes(tag)) {
            if (tags.length < 10) {
                tag.split(',').forEach(tag => {
                    tags.push(tag);
                    createTag();
                });
            }
        }
        e.target.value = "";
    }
}

input.addEventListener("keyup", addTag);

removeBtn.addEventListener("click", () => {
    tags.length = 0;
    ul.querySelectorAll("li").forEach(li => li.remove());
    countTags();
});


function showArray() {
    let text = tags.toString();
    showTagId.value = text;
    console.log(text);
}

function showArrayCreate() {
    let text = showTagId.value;
    if (!text) {
        console.log(tags);
    } else {
        tags = text.split(",");
        console.log(tags);
    }
}
