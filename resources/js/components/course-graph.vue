<template>
    <div class="block-no-hover">
      <button class="btn btn-primary mb-4" @click="toggleGraph">
        {{ showGraph ? 'Скрыть' : 'Показать' }} граф шагов курса
      </button>
      <div v-if="showGraph" class="graph-container">
        <div id="course-graph"></div>
        <div v-if="showInfoPanel" class="info-panel">
          <div v-if="info">
            <div class="info-header">
              <strong>{{ info.name }}</strong>
              <span class="close-btn" @click="hideInfo">✖</span>
            </div>
            <div>{{ info.description }}</div>
            <div>Время: {{ info.time }} ч</div>
            <ul>
              <li v-for="(link, index) in info.urls" :key="index">
                <a :href="link.url" target="_blank">{{ index + 1 }}. {{ link.url }}</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import * as d3 from "d3";
  
  export default {
    props: {
      steps: {
        type: Object,
        required: true,
      },
    },
    data() {
      return {
        showGraph: false,
        showInfoPanel: false, // Для отображения контейнера с информацией
        info: null, // Данные для отображения
      };
    },
    methods: {
      toggleGraph() {
        this.showGraph = !this.showGraph;
        if (this.showGraph) {
          this.$nextTick(() => {
            this.drawGraph();
          });
        } else {
          this.clearGraph();
        }
      },
      drawGraph() {
        const steps = this.steps;
        const container = document.getElementById("course-graph");
        const width = container.clientWidth - (this.showInfoPanel ? 250 : 20); // Снижаем ширину на 250px для контейнера информации
        const height = 600;
  
        const svg = d3
          .select("#course-graph")
          .append("svg")
          .attr("width", width)
          .attr("height", height);
  
        const nodes = [];
        const links = [];
  
        const traverseSteps = (step, parent = null) => {
          nodes.push({
            id: step.id,
            name: step.name,
            description: step.description,
            time: step.average_completion_time,
            urls: step.urls
          });
          if (parent) {
            links.push({ source: parent.id, target: step.id });
          }
          step.nextSteps.forEach((child) => traverseSteps(child, step));
        };
        traverseSteps(steps);
  
        console.log(nodes);
        const simulation = d3
          .forceSimulation(nodes)
          .force(
            "link",
            d3.forceLink(links).id((d) => d.id).distance(150)
          )
          .force("charge", d3.forceManyBody().strength(-500))
          .force("center", d3.forceCenter(width / 2, height / 2));
  
        const link = svg
          .selectAll(".link")
          .data(links)
          .enter()
          .append("line")
          .attr("class", "link")
          .attr("stroke", "#999")
          .attr("stroke-width", 2);
  
        const node = svg
          .selectAll(".node")
          .data(nodes)
          .enter()
          .append("circle")
          .attr("class", "node")
          .attr("r", 10)
          .attr("fill", "#007bff")
          .call(
            d3
              .drag()
              .on("start", (event, d) => {
                if (!event.active) simulation.alphaTarget(0.3).restart();
                d.fx = event.x;
                d.fy = event.y;
              })
              .on("drag", (event, d) => {
                d.fx = event.x;
                d.fy = event.y;
              })
              .on("end", (event, d) => {
                if (!event.active) simulation.alphaTarget(0);
                d.fx = null;
                d.fy = null;
              })
          )
          .on("click", (event, d) => {
            this.showInfo(d, event);
          });
  
        simulation.alpha(1).restart();
  
        simulation.on("tick", () => {
          link
            .attr("x1", (d) => d.source.x)
            .attr("y1", (d) => d.source.y)
            .attr("x2", (d) => d.target.x)
            .attr("y2", (d) => d.target.y);
  
          node.attr("cx", (d) => d.x).attr("cy", (d) => d.y);
        });
      },
      clearGraph() {
        d3.select("#course-graph").selectAll("*").remove();
      },
      showInfo(data, event) {
        // Закрываем старую подсказку, если она есть
        this.hideInfo();
  
        this.showInfoPanel = true;
        this.info = {
          name: data.name,
          description: data.description,
          time: data.time,
          links: data.links || [],
          urls: data.urls || [],
        };
        this.$nextTick(() => {
            const svg = d3.select("#course-graph svg");
            if (!svg.empty()) { 
                const container = document.getElementById("course-graph");
                const newWidth = container.clientWidth - 250; // Уменьшаем ширину на ширину info-panel
                svg.attr("width", newWidth); // Меняем ширину SVG
            }
        });
      },
      hideInfo() {
        this.showInfoPanel = false;
        this.$nextTick(() => {
            const svg = d3.select("#course-graph svg");
            if (!svg.empty()) {
                const container = document.getElementById("course-graph");
                const originalWidth = container.clientWidth - 20; // Исходная   
                svg.attr("width", originalWidth);
            }
        });
      },
    },
  };
  </script>
  
  <style>
  .graph-container {
    display: flex;
  }
  
  #course-graph {
    flex: 1;
    transition: width 0.3s ease;
  }
  #course-graph svg {
    transition: width 0.3s ease;
  }
  .info-panel {
    width: 250px;
    background-color: #f7f7f7;
    padding: 10px;
    border-radius: 12px;
    border: 1px solid #ccc;
    overflow-y: auto;
    transition: width 0.3s ease;
  }
  
  .node {
    cursor: pointer;
  }
  
  .info-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .info-panel a {
    display: block;
    white-space: nowrap; /* Не позволяет тексту переноситься */
    overflow: hidden; /* Обрезает текст, который выходит за пределы */
    text-overflow: ellipsis; /* Добавляет троеточие, если текст обрезается */
    max-width: 100%; /* Ограничивает ширину ссылки по ширине контейнера */
    color: #007bff;
    text-decoration: none;
    }
  
  .close-btn {
    cursor: pointer;
    font-size: 16px;
    color: #333;
  }
  .info-panel ul {
  list-style-type: none;
  padding-left: 0;
}

.info-panel li {
  margin-bottom: 5px;
}
.info-panel a:hover {
  text-decoration: underline;
}
  
  </style>
  