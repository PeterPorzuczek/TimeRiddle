function showHideElement(id) {
	const element = document.getElementById(id);

	if(!element)
		return;

	if(element.style.display === "none") {
		element.style.display = "block";
    } else {
		element.style.display = "none"
	}
}

function removeElement(id) {
    const element = document.getElementById(id);

    if (element)
        element.remove();
}

function removeToggleCodeButton() {
    Array.from(document.getElementsByClassName('code-toolbar')).forEach( (element, index) => {
        removeElement(`code-${index}-toggle`);
    });
}

function addShowHideButtonToCodeElements() {
    Array.from(document.getElementsByClassName('code-toolbar')).forEach( (element, index) => {
        removeElement(`code-${index}-toggle`);

        element.id = `code-${index}`;
        element.style.display = "none";

        const toggle = `<div id="code-${index}-toggle" onclick="showHideElement('code-${index}')" class="code-toggle">🔎️️</div>`;

        if (element.previousElementSibling.nodeName == "UL") {
            element.previousElementSibling.lastElementChild.insertAdjacentHTML('beforeend', toggle);
        } else {
            element.previousElementSibling.insertAdjacentHTML('beforeend', toggle);
        }
    });
}

function isValidJson(json) {
    try {
        if (document.getElementsByClassName('jsonarea').length > 0) {
            JSON.parse(document.getElementsByClassName('jsonarea')[0].value);
        }
        return true;
    } catch (e) {
        if (document.getElementsByClassName('jsonarea').length > 0) {
            document.getElementsByClassName('jsonarea')[0].style.border = "1px solid red";
        }
        return false;
    }
}

function addToggle() {
    removeToggleCodeButton();
    addShowHideButtonToCodeElements();
}

function updateRenderedMarkdown() {
    removeToggleCodeButton();
    document.body.innerHTML = document.body.innerHTML.replace(/\{spc\{/ig, '{{');
    document.body.innerHTML = document.body.innerHTML.replace(/<pre class="(?!line-numbers)/ig, '<pre class="line-numbers ');
    Prism.highlightAll();
}

document.addEventListener("DOMContentLoaded", function(event) {
    updateRenderedMarkdown();
});
document.addEventListener("turbolinks:before-render", function () {
    updateRenderedMarkdown();

});
document.addEventListener("turbolinks:render", function () {
    updateRenderedMarkdown();
});
