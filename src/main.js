// Current year
const getCurrentYear = () => {
    const currentYear = new Date().getFullYear()
    const currentYearEl = document.getElementById("current-year")
    if (currentYearEl) {
        currentYearEl.innerHTML = currentYear
    }
}
getCurrentYear();