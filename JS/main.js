
// Back To Top Button
const topBtn = document.getElementById("backTop");

window.addEventListener("scroll", () => {
    topBtn.style.display = window.scrollY > 300 ? "block" : "none";
});

topBtn.onclick = () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
};
// Image Slider
let sliderImages = document.querySelectorAll('.img11');
let currIndex = 0;

function showImage(index) {
    sliderImages.forEach(img => img.classList.remove("active"));
    sliderImages[index].classList.add("active");
}

function slider(n) {
    currIndex += n;

    if (currIndex < 0) {
        currIndex = sliderImages.length - 1;
    } else if (currIndex >= sliderImages.length) {
        currIndex = 0;
    }

    showImage(currIndex);
}

function startSlider() {
    setInterval(() => {
        slider(1);
    }, 3000);
}

startSlider();

// FAQ Toggle
document.querySelectorAll(".faq-item").forEach(item => {
    item.addEventListener("click", () => {
        const answer = item.querySelector(".faq-answer");
        answer.classList.toggle("show");
    });
});

window.addEventListener("scroll", () => {
    const progress = document.getElementById("scroll-progress");
    let value = (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100;
    progress.style.width = value + "%";
});

const words = ["Bold", "Fresh", "Elegant", "Unique"];
let idx = 0;

setInterval(() => {
    idx = (idx + 1) % words.length;
    document.getElementById("rotating").textContent = "Perfumes designed for you — " + words[idx];
}, 2000);


