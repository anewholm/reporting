cEl(
  "div", {
    id: "progressHeader",
    style: {
      "font-family": "Arial",
      "text-align": "center"
    }
  }, [
    gMsg("Initializing Xavier - this will take a few moments."),
    cEl("br"),
    gMsg("Progress: "),
    cEl("progress", {
      id: "progress",
      max: 15000,
      value: 0,
      style: {
        "height": "25px",
        "width": "200px"
      }
    }),
    cEl("br"),
    gMsg("For quicker bootstrap, consider moving away from the embedded sample database.")
  ], document.body
);

var progressId = setInterval(function(){
  var el = gEl("progress");
  sAtt(el, "value", el.value + 100);
}, 100);

function initialized(){
  dEl("progressHeader");
  busy(false);
  clearInterval(progressId);
}
