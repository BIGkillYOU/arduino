new Vue({
  el: '#app',
  data: {
    columns: ['Index', 'EN', 'Name Surname', 'Course name', 'Length(hr.)', 'Type', 'Group', 'Actions '],
    persons: [{
      EN: "1",
      NameSurname: "2",
      Coursename: "3",
      Length: "4",
      Type: "5",
      group: "6"
    }],
    bin: [],
    input: {
      EN: "",
      NameSurname: "",
      Coursename: "",
      Length: "",
      Type: "",
      group: ""
    },
    editInput: {
      EN: "",
      NameSurname: "",
      Coursename: 0,
      Length: "",
      Type: "",
      group: ""
    }
  },
  methods: {
    /*//function to add data to table
    add: function() {
      this.persons.push({
        EN: this.input.EN,
        NameSurname: this.input.NameSurname,
        Coursename: this.input.Coursename,
        Length: this.input.Length,
        Type: this.input.Type,
        group: this.input.group
      });

      for (var key in this.input) {
        this.input[key] = '';
      }
      this.persons.sort(ordonner);
      this.$refs.EN.focus();
    },*/
    //function to handle data edition
    edit: function(index) {
      this.editInput = this.persons[index];
      console.log(this.editInput);
      this.persons.splice(index, 1);
    },
    //function to send data to bin
    archive: function(index) {
      this.bin.push(this.persons[index]);
      this.persons.splice(index, 1);
      this.bin.sort(ordonner);
    },
    //function to restore data
    restore: function(index) {
      this.persons.push(this.bin[index]);
      this.bin.splice(index, 1);
      this.bin.sort(ordonner);
    },
    //function to update data
    update: function(){
      // this.persons.push(this.editInput);
       this.persons.push({
        EN: this.editInput.EN,
        NameSurname: this.editInput.NameSurname,
        Coursename: this.editInput.Coursename,
        Length: this.editInput.Length,
        Type: this.editInput.Type,
        group: this.editInput.group
      });
       for (var key in this.editInput) {
        this.editInput[key] = '';
      }
      this.persons.sort(ordonner);
    },
    //function to defintely delete data 
    deplete: function(index) {
      // console.log(this.bin[index]);
      this.bin.splice(index, 1);
    }
  }
});

//function to sort table data alphabetically
var ordonner = function(a, b) {
  return (a.EN > b.EN);
};

$(function() {
  //initialize modal box with jquery
  $('.modal').modal();
});
