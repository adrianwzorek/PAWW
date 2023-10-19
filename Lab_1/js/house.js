$("#name").hide();
$("#people").hide();
$("#info").hide();
$("#hero").hide();
$("th").hide();
const showTitle = () => {
  $("#people").fadeIn(3000);
  $("#name").fadeIn(2000);
  $("#info").fadeIn(2000);
  $("#hero").fadeToggle(2000);
  $("#herb").animate(
    {
      left: 20,
      top: "8%",
      fontSize: "120%",
    },
    2000
  );
};

const showStudent = () => {
  $("th").fadeToggle(1000);
};
