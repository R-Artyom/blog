
const focusElement = document.getElementsByClassName('focus')
focusElement[0].focus()
focusElement[0].scrollIntoView({
    behavior: "smooth",
    block: "center",
    inline: "start"
});
