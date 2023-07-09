export const BmiCalculator = { 
  template: '<div><h2>BMI Calculator</h2><form @submit.prevent="calculate"><label>Height (cm): <input v-model="height" type="number" required></label><br><label>Weight (kg): <input v-model="weight" type="number" required></label><br><button type="submit">Calculate BMI</button><br><br><div v-if="bmiResult">{{ bmiResult }}</div></form></div>',
  data() {
    return {
      height: null,
      weight: null,
      bmiResult: null
    }
  },
  methods: {
    calculate() {
      const bmi = (this.weight / ((this.height / 100) ** 2)).toFixed(2);
      this.bmiResult = `Your BMI is ${bmi}.`;
    }
  }
}