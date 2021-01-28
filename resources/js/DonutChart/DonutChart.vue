<template>
    <div class="circle_result" id="circle" data-percent="12.3">
                <label class="win_rate_lable_circle">Win Rate</label>
                </div>
</template>
<script>
export default {
  name: "Donutchart",
  data() {
    return {};
  },
  mounted() {
    this.drawDonut();
  },
  methods: {
    drawDonut() {
      const { template } = require("lodash");

      var el = document.getElementById("circle"); // get canvas
      var options = {
        percent: el.getAttribute("data-percent") || 25,
        size: el.getAttribute("data-size") || 220,
        lineWidth: el.getAttribute("data-line") || 9,
        rotate: el.getAttribute("data-rotate") || 0,
      };
      var canvas = document.createElement("canvas");
      var span = document.createElement("label");
      span.setAttribute("class", "circle_label_in");
      span.textContent = options.percent + "%";

      if (typeof G_vmlCanvasManager !== "undefined") {
        G_vmlCanvasManager.initElement(canvas);
      }

      var ctx = canvas.getContext("2d");
      canvas.width = canvas.height = options.size;

      el.appendChild(span);
      el.appendChild(canvas);

      ctx.translate(options.size / 2, options.size / 2); // change center
      ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI); // rotate -90 deg

      //imd = ctx.getImageData(0, 0, 240, 240);
      var radius = (options.size - options.lineWidth) / 2.5; //cirgle grosse

      var drawCircle = function (color, lineWidth, percent, lineHeight) {
        percent = Math.min(Math.max(0, percent || 0), 1);
        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
        ctx.strokeStyle = color;
        ctx.lineCap = "round"; // butt, round or square
        ctx.lineWidth = lineWidth;
        ctx.stroke();
      };

      drawCircle("#f5f5f9", options.lineWidth, 100 / 100);
      drawCircle("#3490dc", options.lineWidth, options.percent / 100);
    },
  },
};
</script>
<style>
.circle_result {
  position: relative;
  display: flex;
  justify-content: center;
  align-content: center;
  align-items: center;
}

.circle_result .circle_label_in {
  position: absolute;
  margin-top: 24px;
  color: var(--dark);
  font-size: 1.46rem;

  font-weight: 500;
}
.win_rate_lable_circle {
  position: absolute;
  font-size: var(--font-lg);
  margin-top: -24px;
  color: var(--lighter);
  font-weight: 400 !important;
}
</style>



