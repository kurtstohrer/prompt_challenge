  <template>
    <div id="app " class="bg-blue-600 p-5 h-screen overflow-hidden">
      <div class="container mx-auto px-4 h-screen OVER">
        <div class="grid grid-cols-2 gap-4">
          <div class="bg-white p-5 h-screen overflow-scroll" ><survey :data="surveyData" ></survey></div>
          <div class="bg-white p-5 h-screen overflow-scroll" >
            
            <!-- output of jsons data structure that defines form -->
            <vue-json-pretty
              :path="'res'"
              :data="surveyData"
              >
            </vue-json-pretty>
          </div>
          
        </div>
      </div>
  

    </div>
  </template>

  <script>
  import Survey from './components/Survey.vue'
  import SurveyData from './assets/data.json'
  import VueJsonPretty from 'vue-json-pretty'

  export default {
    name: 'App',
    components: {
     "survey":Survey,
     VueJsonPretty
    },
    data() {
    return {
      // Initialized to zero to begin
      surveyData: SurveyData
    }
  },
  }
  </script>
