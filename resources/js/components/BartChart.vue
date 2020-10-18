<template>
  <div id="container-chart" class="pt-2" align="center">
    <h4 class="my-4">{{ title }}</h4>
    <div id="bar-chart" align="center"></div>
  </div>
</template>

<script>
import * as d3 from "d3";
import _ from "lodash";

export default {
  name: "BartChart",
  props: {
    title: String,
    xKey: String,
    yKey: String,
    data: Array,
  },
  mounted() {
    this.drawSvgBartChart();
    this.svgWidth = d3
      .select("#bar-chart")
      .node()
      .getBoundingClientRect().width;
  },
  data: () => ({
    chart: null,
    svgWidth: null,
  }),
  methods: {
    drawSvgBartChart() {
      this.svgWidth = 200;

      const svg = d3
        .select("#bar-chart")
        .append("svg")
        .attr("id", "svg-bar-chart")
        .attr("align", "center")
        .attr("class", "mx-2")
        .attr("viewBox", `0 0 200 100`)
        .attr("preserveAspectRatio", "xMinYMin");

      const bars = svg
        .append("g")
        .attr("class", "bars")
        .attr("width", `100%`)
        .attr("height", `100%`);

      bars
        .selectAll("rect")
        .data(this.data)
        .enter()
        .append("rect")
        .attr("x", (d) => this.xScale(d[this.xKey]))
        .attr("y", (d) => this.yScale(d[this.yKey]) - 20)
        .attr("width", this.xScale.bandwidth())
        .attr("height", (d) => this.svgHeight - this.yScale(d[this.yKey]))
        .attr("class", "bar-positive");

      bars
        .append("g")
        .attr("class", "container-bar-text")
        .selectAll("text")
        .data(this.data)
        .enter()
        .append("text")
        .text((d) => `${d[this.yKey]}`)
        .attr("x", (d) => this.xScale(d[this.xKey]))
        .attr("y", (d) => this.dataMax / 0.45)
        .attr("font-family", "sans-serif")
        .attr("font-size", "8px")
        .attr("fill", "white")
        .attr("transform", `translate(${this.xScale.bandwidth() / 2.8}, 0)`)
        .attr("class", "bar-text");

      svg
        .append("g")
        .attr("transform", `translate(0, ${this.svgHeight - 20})`)
        .call(d3.axisBottom(this.xScale).tickSize(0))
        .selectAll("text")
        .style("text-anchor", "end")
        .attr("dx", "-.8em")
        .attr("dy", ".15em")
        .attr("font-size", "4px")
        .attr("transform", (d) => "rotate(-20)");
    },
  },
  computed: {
    dataMax() {
      return d3.max(this.data, (d) => {
        return d[this.yKey];
      });
    },
    dataMin() {
      return d3.min(this.data, (d) => {
        return d[this.yKey];
      });
    },
    xScale() {
      return d3
        .scaleBand()
        .rangeRound([0, this.svgWidth])
        .paddingInner(0.05)
        .paddingOuter(0.2)
        .domain(
          this.data.map((d) => {
            return d[this.xKey];
          })
        );
    },
    yScale() {
      return d3
        .scaleLinear()
        .rangeRound([this.svgHeight, 0])
        .domain([this.dataMin > 0 ? 0 : this.dataMin, this.dataMax]);
    },
    svgHeight() {
      return this.svgWidth / 2;
    },
  },
};
</script>

<style lang="scss">
#bar-chart {
  width: 100%;
}
.bar-positive {
  fill: #967dff;
  transition: all 0.2s;
}
.bar-positive:hover {
  fill: #886add;

  & ~ .container-bar-text > .bar-text {
    font-weight: bold;
  }
}
</style>