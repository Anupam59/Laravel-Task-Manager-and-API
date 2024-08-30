
const ul2 = document.querySelector("#ulId2"),
    input2 = document.querySelector("#inputId2"),
    tagNumb2 = document.querySelector("#detailsItem2"),
    removeBtn2 = document.querySelector("#removeBtn2"),
    showTagId2 = document.querySelector("#showTagId2");
let maxTags2 = 10, tags2 = [];


showArrayCreate2();
countTags2();
createTag2();
showArray2();


function countTags2() {
    input2.focus();
    tagNumb2.innerText = maxTags2 - tags2.length;
    showArray2();
}

function createTag2() {
    ul2.querySelectorAll("li").forEach(li => li.remove());
    tags2.slice().reverse().forEach(tag => {
        let liTag = `<li>${tag} <i class="uit uit-multiply" onclick="remove1(this, '${tag}')"></i></li>`;
        ul2.insertAdjacentHTML("afterbegin", liTag);
    });
    countTags2();
}

function remove1(element, tag) {
    let index = tags2.indexOf(tag);
    tags2 = [...tags2.slice(0, index), ...tags2.slice(index + 1)];
    element.parentElement.remove();
    countTags2();
}

function addTag2(e) {
    if (e.key == "Enter") {
        let tag = e.target.value.replace(/\s+/g, ' ');
        if (tag.length > 1 && !tags2.includes(tag)) {
            if (tags2.length < 10) {
                tag.split(',').forEach(tag => {
                    tags2.push(tag);
                    createTag2();
                });
            }
        }
        e.target.value = "";
    }
}

input2.addEventListener("keyup", addTag2);

removeBtn2.addEventListener("click", () => {
    tags2.length = 0;
    ul2.querySelectorAll("li").forEach(li => li.remove());
    countTags2();
});


function showArray2() {
    let text = tags2.toString();
    showTagId2.value = text;
    console.log(text);
}

function showArrayCreate2() {
    let text = showTagId2.value;
    if (!text) {
        console.log(tags2);
    } else {
        tags2 = text.split(",");
        console.log(tags2);
    }
}
