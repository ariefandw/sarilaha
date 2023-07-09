export const Counter = { 
  template: document.querySelector('template').innerHTML,
  data() {
    return {
      count: 0
    }
  },
  methods: {
    increment() {
      this.count++
    }
  }
}
