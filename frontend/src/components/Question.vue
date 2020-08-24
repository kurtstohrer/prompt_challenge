  <template>
    <div class="question py-3">
      <!-- if Question type is number render out number input --> 
      <input-number v-if="question.type == 'N'" :label="question.text" :min="question.min || 0" v-model="question.response"></input-number>

      <!-- if Question type is True / False render out checkbox for a true false --> 
      <input-checkbox v-if="question.type == 'TF'" :label="question.text" v-model="question.response" :options="TF_options" :min="1" :max="1"></input-checkbox>

       <!-- if Question type is True / False render out checkbox for a true false --> 
      <input-checkbox v-if="question.type == 'MC'" :label="question.text" v-model="question.response" :options="question.options" :min="question.min" :max="question.max" :info="message"></input-checkbox>


      <!--- Sub questions -->
      <template v-if="question.questions.length > 0 && positive">
        <template v-for="(q,i) in question.questions">
            <question :question="q" :key="'question-'+i"></question>
        </template>
      </template>
    </div>
  </template>

  <script>


  export default {
    name: 'Question',
    props:{
        question:Object,
       
    },
    data() {
        return {
         
           TF_options:[
             {
               "label":"True",
               "value":true
             },
              {
               "label":"False",
               "value":false
             }
           ]
        }
    },
    created(){
      switch(this.type){
            case "N":
              this.question.response = 0;
              break
            case "TF":
                this.question.response = [];
              break
            case "MC":
                this.question.response = [];
              break
          }
    },
    computed:{
      positive(){
        if(this.question.response == undefined){
          return false
        }
          let pass = false;
          switch(this.question.type){
            case "N":
              pass = this.question.response > 0;
              break
            case "TF":
              pass = this.question.response == true;
              break
            case "MC":
              let min = this.question.min,
                  max = this.question.max;
                console.log('mc')
                   console.log(this.question.response)
              // if min equals max check to make sure question.response length = max (required # of choices)
              if(min === max){
                // handle single radio resposne  
                if(max == 1){
              
                   pass = this.question.response.length != 0 ;
                }else{
                   pass = this.question.response.length == max; 
                }
               
              // else if there is a minimum make sure the selected count is equal to or greater than the min
              }else if(min && max){ 
                pass = this.question.response.length >= min &&  this.question.response.length <= max;
              }else if(max){
                pass = this.question.response.length <= max;
              }else if(min){
                 pass = this.question.response.length >= min;   
              }else{
                pass = true
              }
              break
          }

          return pass;
      },
      message(){
          let info = "";
          switch(this.question.type){
            case "MC":
              let min = this.question.min,
                  max = this.question.max;
              // if min equals max check to make sure question.response length = max (required # of choices)
              if(min === max){
               info = 'Choose ' + min;
              // else if there is a minimum make sure the selected count is equal to or greater than the min
              }else if(min && max){ 
                info = 'Choose Between ' + min + ' and ' + max;
              }else if(max){
                info = 'Choose up to ' + max;
              }else if(min){
                info = 'Choose at least ' + min;
              }
              break
          }
          info = "(" + info + ")"
          return info;
    }
    }
    
    
  }
  </script>
