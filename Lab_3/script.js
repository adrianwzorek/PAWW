const magic = () => {
  $(".incognito").show(500);

  $("#one").animate(
    {
      "font-size": 50,
      width: 350,
      height: 350,
    },
    500
  );
};

const magic_back = () => {
  $(".incognito").hide(500);
  $("#one").animate(
    {
      "font-size": 30,
      width: 150,
      height: 150,
    },
    500
  );
};

$("#one").on({
  mouseenter: magic,
  mouseleave: magic_back,
});
// Tworzenie elementu
