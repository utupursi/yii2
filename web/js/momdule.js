function getDatabase(){
    const students={};
    const subjects={};
    let masivi=[];

    return{
        addStudent,
        updateStudent,
        getAllStudents,
        removeStudent,
        getStudentById,
        addSubject,
        getSubjects,
        addStudentToSubject,
        getSubjectsForStudent

    };

    function addStudent(personalId,student){
        student.personalId=personalId;
        students[personalId]=student;
        console.log(students);
    }

    function updateStudent(personalId,student){
        if(students[personalId]){

            student.personalId=personalId;
            students[personalId]=student;

        }
    }

    function removeStudent(personalId){
        delete students[personalId];

    }

    function getAllStudents(){
        return Object.values(students);
    }

    function getStudentById(personalId){
        return students[personalId];
    }

    function addSubject(code,title){
        subjects[code]=title;
    }

    function getSubjects(){
        return subjects;
    }

    function addStudentToSubject(personalId,code){
        subjects[code].studentid=personalId;
    }

    function getSubjectsForStudent(personalId){
        var h=0;

        for(let i in subjects){

            if(subjects[i].studentid==personalId){
                masivi[h]=subjects[i].subjectname;
                h++;
            }
        }

        if(h>0){
            return masivi;
        }

        else
            return 'არ არსებობს';


    }
}


const database=getDatabase();
const personalId=0;
database.addStudent('12345',{
    name:'Giorgi',
    surname:'Beridze',
    age:22
});
database.addStudent('1',{
    name:'Levan',
    surname:'Gogoladze',
    age:30
});

database.updateStudent('12345',{
    name:'Sasha',
    surname:'Kirvalidze',
    age:28
});

database.removeStudent('12245');
database.getAllStudents();
console.log(database.getAllStudents());
console.log(database.getStudentById('12345'));


database.addSubject('12',{
    subjectname:'fizika'

});
database.addSubject('89',{
    subjectname:'Math'

});
console.log(database.getSubjects());
database.addStudentToSubject('225','12');
database.addStudentToSubject('225','89');
console.log(database.getSubjectsForStudent('225'));



const obj={
    name:'giorgi',
    surname:'bakhbaia',
}
const obj1={};
obj.personalid=223;
obj1[123]=obj;
console.log(obj1);
console.log(obj);




class Animal{

constructor(){
    this.students={};
}

m(){
console.log('f');
}
    //  updateStudent(personalId,student){
    //     if(this.obj2[personalId]){
    //         student.personalId=personalId;
    //         this.obj2[personalId]=student;
    //         console.log(this.obj2);
    //     }
    // }

}

class Student extends Animal{
  constructor(){
      super();
      console.log(this.students);
  }
  m() {
    super.m();
  }
    addStudent(personalId,student){
        console.log(student);
        console.log(student.name);
        this.students[personalId]=student;
        console.log(this.students);
    }


}




const animal=new Animal();
const student=new Student();
student.addStudent(123,{name:'gIORGI',surname:'bakhbaia'});
student.m();
// animal.updateStudent(123,{name:'jvebe',surname:'jvebadze'})



function l(name){
this.name=name;


}
l.prototype.greeting=function(){
    console.log('hi');
}

food.prototype = Object.create(l.prototype);
Object.defineProperty(food.prototype, 'constructor', {
    value: food,
    enumerable: false, // so that it does not appear in 'for in' loop
    writable: true });

function food(name,subject) {
    l.call(this, name);
    this.subject=subject;

}


console.log(food.prototype.constructor);
var d=new l('giorgi');
var dog=new food('gio','history');
console.log(dog.name);
dog.greeting();


for (var i=1; i<=5; i++) {
    setTimeout( function timer(){
        console.log( i );
    }, i*1000 );
}