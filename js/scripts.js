
const focusElement = document.getElementsByClassName('focus')
if (focusElement.length > 0) {
    focusElement[0].focus()
    focusElement[0].scrollIntoView({
        behavior: "smooth",
        block: "center",
        inline: "start"
    });
}
