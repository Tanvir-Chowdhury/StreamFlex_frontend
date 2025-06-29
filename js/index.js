document.addEventListener("DOMContentLoaded", function () {
  const slider = document.getElementById("slider");
  const prevButton = document.getElementById("prev-slide");
  const nextButton = document.getElementById("next-slide");

  const getCardWidth = () => {
    const firstCard = slider.querySelector(".movie-card");
    if (!firstCard) return 0;
    const cardStyle = window.getComputedStyle(firstCard);
    const cardMarginRight = parseInt(cardStyle.marginRight) || 20;
    return firstCard.offsetWidth + cardMarginRight;
  };

  nextButton.addEventListener("click", () => {
    const cardWidth = getCardWidth();
    slider.scrollBy({ left: cardWidth, behavior: "smooth" });
  });

  prevButton.addEventListener("click", () => {
    const cardWidth = getCardWidth();
    slider.scrollBy({ left: -cardWidth, behavior: "smooth" });
  });
});

// For series
document.addEventListener("DOMContentLoaded", function () {
  const slider = document.getElementById("slider2");
  const prevButton = document.getElementById("prev-slide2");
  const nextButton = document.getElementById("next-slide2");

  const getCardWidth = () => {
    const firstCard = slider.querySelector(".series-card");
    if (!firstCard) return 0;
    const cardStyle = window.getComputedStyle(firstCard);
    const cardMarginRight = parseInt(cardStyle.marginRight) || 20;
    return firstCard.offsetWidth + cardMarginRight;
  };

  nextButton.addEventListener("click", () => {
    const cardWidth = getCardWidth();
    slider.scrollBy({ left: cardWidth, behavior: "smooth" });
  });

  prevButton.addEventListener("click", () => {
    const cardWidth = getCardWidth();
    slider.scrollBy({ left: -cardWidth, behavior: "smooth" });
  });
});

//For billing toggle button
const billingToggle = document.getElementById("billingToggle");
billingToggle.addEventListener("click", () => {
  const price_basic = document.getElementById("price-basic");
  const price_standard = document.getElementById("price-standard");
  const price_premium = document.getElementById("price-premium");
  const priceText = document.querySelectorAll(".price-text");
  if (billingToggle.checked) {
    price_basic.innerHTML = "2680 Tk";
    price_standard.innerHTML = "3200 Tk";
    price_premium.innerHTML = "4800 Tk";

    priceText.forEach((e) => {
      e.innerHTML = "/year";
    });
  } else {
    price_basic.innerHTML = "280 Tk";
    price_standard.innerHTML = "340 Tk";
    price_premium.innerHTML = "510 Tk";

    priceText.forEach((e) => {
      e.innerHTML = "/month";
    });
  }
});
