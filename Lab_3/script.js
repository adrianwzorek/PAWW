$("#one").on({
  mouseenter: () => {
    $("#one").animate({
      "font-size": 50,
      width: 350,
      height: 350,
    });
  },
  mouseleave: () => {
    $("#one").animate({
      "font-size": 30,
      width: 150,
      height: 150,
    });
  },
});

// Tworzenie elementu
const element = `<div class="incognito">Hey :D</div>`;
