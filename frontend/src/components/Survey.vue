  <template>
    <div id="Survey">
    <div class="text-lg font-bold">{{data.title}}</div>
    <template v-if="data.questions.length > 0">
        <template v-for="(q,i) in data.questions">
            <question :question="q" :key="'question-'+i"></question>
        </template>
      </template>
    </div>
  </template>

  <script>


  export default {
    name: 'Survey',
    props:{
        data:Object,
    },
    data() {
        return {
     
        }
    },
    components: {
    }
  }
  </script>