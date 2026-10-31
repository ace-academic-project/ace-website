let currentSlide = 0;

let images = ["Assets/Images/image1(1).png","Assets/Images/image2.png","Assets/Images/image4.png"];


function showSlide(index){
    let slide = document.getElementById("slide");
    slide.src = images[index];
}

function nextSlide(){
    currentSlide = (currentSlide + 1) % images.length;
    showSlide(currentSlide);
}

function prevSlide(){
    currentSlide = (currentSlide - 1 + images.length) % images.length;
    showSlide(currentSlide);
}

setInterval(nextSlide,5000);


document.addEventListener("DOMContentLoaded", () => {
  const faqItems = document.querySelectorAll(".faq-item");

  faqItems.forEach((item) => {
    const questionHeader = item.querySelector(".faq-question");
    const answer = item.querySelector(".faq-answer");

    questionHeader.addEventListener("click", () => {
      const isCurrentlyActive = item.classList.contains("active");

      // Close all other active items
      faqItems.forEach((otherItem) => {
        if (otherItem !== item) {
          otherItem.classList.remove("active");
          otherItem.querySelector(".faq-answer").style.maxHeight = "0px";
        }
      });

      // Toggle current item
      if (isCurrentlyActive) {
        item.classList.remove("active");
        answer.style.maxHeight = "0px";
      } else {
        item.classList.add("active");
        answer.style.maxHeight = answer.scrollHeight + "px";
      }
    });
  });
});