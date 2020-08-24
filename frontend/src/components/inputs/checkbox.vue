<template>

    <div class="field checkbox py-2 ">
             <label class="block tracking-wide text-gray-700 text-base font-semibold  " for="grid-first-name">
               {{label}}
              </label>
              <span :class="'block help text-sm mb-2'"  v-html="message"></span>
            <div class="control">
                <template v-for="(option,i) in options">
                    <label class="inline-flex items-center pr-2" :key="'cb-opt-'+i">
                        <input :type="type" :id="'opt-'+i" class="form-radio" v-model="inputVal" :value="option.value" :disabled="inputVal.length >= max && inputVal.indexOf(option.value) === -1 && type == 'checkbox'" >
                        <span class="ml-2">{{option.label}}</span>
                    </label>
                </template>
              
               
                
            </div>
        </div>

</template>

<script>

export default {
  name: 'checkboxes',
  props:{
      label:String,
      value:{
          type:[String,Number,Array,Boolean],
          default: () => { return []}
      },
      info:String,
      options:Array,
      min:{
        type: Number,
        default: 1
      },
      max:{
        type: Number,
        default: 9999999
      }
  },
  data: function () {
    return {
     inputVal: this.value, 
      message: this.info,
      inputclass:"",
      type:"checkbox"
    }
  },
  components: {
  },
  created:function(){
    // make the inputs
    if(this.max == 1 && this.min == 1){
        this.type = "radio"    
    }


   
  },
  methods: {
     
  },
  watch: {
    inputVal(val) {
        console.log(val)
      this.$emit('input', val);
    }
  }
}
</script>
