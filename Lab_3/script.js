$(".incognito").hide();

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

const gradient_on = () => {
  $("h1").css({
    background:
      "linear-gradient(90deg, rgba(23,172,203,1) 4%, rgba(6,97,125,1) 90%)",
  });
};

let move = true;

const animation = () => {
  $("span").animate(
    {
      padding: "0 55%",
      fontSize: 50,
    },
    1000
  );

  console.log("a 1");
};

const animation_back = () => {
  $("span").animate(
    {
      padding: 0,
      fontSize: 35,
    },
    1000
  );
  console.log("a 2");
};
