<template>

    <div class="field number-field py-2" >
             <label class="block tracking-wide text-gray-700 text-base font-semibold" for="grid-first-name">
               {{label}}
              </label>
              <span :class="'block help text-sm mb-2'"  v-html="message"></span>
            <div class="control">
                <input :class="'block w-full border-2 rounded border-gray-500 hover:border-gray-600 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white'" :type="'number'" :step="step" :min="min" :max="max" :name="name" v-model="inputVal">
                
            </div>
        </div>

</template>

<script>

export default {
  name: 'number-field',
  props:['label','value','info','name','min','max','step'],
  data: function () {
    return {
     inputVal: this.value, 
      message: this.info,
      inputclass:""
    }
  },
  components: {
  },
  created:function(){

   
  },
  computed: {
 
  },
  methods: {
  
  },
  watch: {
    inputVal(val) {
      this.$emit('input', val);
    }
  }
}
</script>
