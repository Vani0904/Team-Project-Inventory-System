// Get the current dark mode state from the browser's local storage
let darkmode = localStorage.getItem('darkmode')
const themeSwitch = document.getElementById('theme-switch')

// Function to enable dark mod
const enableDarkmode = () => {
    document.body.classList.add('darkmode')
    localStorage.setItem('darkmode', 'active')
}
// Function to disable dark mode
const disableDarkmode = () => {
    document.body.classList.remove('darkmode')
    localStorage.setItem('darkmode', null)
}

// Check if dark mode is already enabled and apply it if necessary
if(darkmode === "active") enableDarkmode()
 // Toggle dark mode based on the current state
themeSwitch.addEventListener("click", () => {
    darkmode = localStorage.getItem('darkmode')
    darkmode !== "active" ? enableDarkmode() : disableDarkmode()

})    