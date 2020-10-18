<template>
  <div id="container-gauge-chart" class="pt-2" align="center">
    <h4 class="my-4">{{ title }}</h4>
    <div id="gauge-chart" align="center"></div>
  </div>
</template>

<script>
import * as d3 from "d3";

export default {
  name: "GaugeChart",
  props: {
    title: String,
    data: String,
  },
  mounted() {
    this.drawSvgGaugeChart();
    this.svgWidth = d3
      .select("#gauge-chart")
      .node()
      .getBoundingClientRect().width;
  },
  data: () => ({
    svgWidth: null,
    status: null,
  }),
  methods: {
    drawSvgGaugeChart() {
      switch (this.data) {
        case "clean":
          this.status = [30];
          break;
        case "warning":
          this.status = [90];
          break;
        case "danger":
          this.status = [155];
          break;
        default:
          this.status = [0];
          break;
      }
      this.svgWidth = 200;
      const margin = 12;
      const r = (this.svgWidth - 2 * margin) / 2;
      const colors = d3.scaleOrdinal(["#9ade96", "#ffa500", "#ff6347"]);

      const svg = d3
        .select("#gauge-chart")
        .append("svg")
        .attr("id", "svg-gauge-chart")
        .attr("align", "center")
        .attr("class", "mx-2")
        .attr("viewBox", `0 0 200 100`)
        .attr("preserveAspectRatio", "xMinYMin");

      const g = svg
        .append("g")
        .attr("transform", `translate(${margin + r}, 80) scale(0.8)`);

      const pie = d3
        .pie()
        .startAngle((-1 * Math.PI) / 2)
        .endAngle(Math.PI / 2);

      const arc = d3
        .arc()
        .outerRadius(r)
        .innerRadius(r - 25)
        .cornerRadius(5)
        .padAngle(0.02)
        .padRadius(100);

      const arcs = g
        .selectAll("arc")
        .data(pie([1, 1, 1]))
        .enter()
        .append("g")
        .attr("class", "arc");

      arcs
        .append("path")
        .attr("fill", (d, i) => {
          return colors(i);
        })
        .attr("d", arc);

      const needle = svg
        .selectAll(".needle")
        .data([0])
        .enter()
        .append("g")
        .append("line")
        .attr("x1", Math.PI)
        .attr("x2", -70)
        .attr("y1", Math.PI)
        .attr("y2", Math.PI)
        .classed("needle", true)
        .style("stroke", "#565660")
        .style("stroke-width", "2px")
        .attr("transform", (d) => {
          return `translate(${margin + r}, 80) rotate(${d}) scale(0.8)`;
        });

      svg
        .selectAll(".needle")
        .data(this.status)
        .transition()
        .ease(d3.easeElasticOut)
        .duration(2000)
        .attr("transform", (d) => {
          return `translate(${margin + r},${
            this.svgHeight - 25
          }) rotate(${d}) scale(0.8)`;
        });

      svg
        .append("g")
        .append("text")
        .attr("x", this.svgWidth / 2)
        .attr("y", this.svgHeight - 10)
        .attr("text-anchor", "middle")
        .style("font-size", "6px")
        .attr("fill", "white")
        .style("text-decoration", "underline")
        .style("font-weight", "bold")
        .text(`${this.$tc("ResultTable.headers.status", 1)} ${this.data}`);
    },
  },
  computed: {
    svgHeight() {
      return this.svgWidth / 2;
    },
  },
};
</script>

<style lang="scss">
#gauge-chart {
  width: 100%;
}
.arc:hover {
  opacity: 0.8;
}
.needle:hover {
  opacity: 0.8;
}
</style>