//objek literal
// let user = {
//   nama : 'Asep',
//   energi : 30,
//   makan : function (porsi){
//     this.energi = this.energi + porsi;
//     console.log(`Hallo ${this.nama}, wilujeung tuang`);
//   }
// }
// let user2 = {
//   nama : 'Asep',
//   energi : 30,
//   makan : function (porsi){
//     this.energi = this.energi + porsi;
//     console.log(`Hallo ${this.nama}, wilujeung tuang`);
//   }
// }


//function declaration
// function frameUser(nama, energi){
//   let user = {}; //ini gak dipake di construktor function
//   user.nama = nama;
//   user.energi = energi;
//
//   user.makan = function(porsi){
//     this.energi += porsi;
//     console.log(`Sumangga ${this.nama}, Wilujeung tuang`);
//   }
//   return user; //sama ini juga gak dipake di construktor function
// }
// let asep = frameUser('Asep Ridwan', 40);

//constructor function
function frameUser(nama, energi){
  this.nama = nama;
  this.energi = energi;

  this.makan = function(porsi){
    this.energi += porsi;
    console.table(`Sumangga ${this.nama}, Wilujeung tuang`);
  }
}
let asep = new frameUser('Asep Ridwan', 40);


//Object.create
