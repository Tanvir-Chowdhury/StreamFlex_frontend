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
