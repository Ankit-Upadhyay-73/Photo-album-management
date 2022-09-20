
let validation_rule = {
    fname       : "required|min:4|nonumber",
    lname       : "required|min:4|nonumber",
    password    : "required|password",
    email       : "required|email"
}

document.querySelector("form").addEventListener("submit",(event)=>{
        let errors = {};
        let form_data = {};
    
        event.preventDefault();

        let form_fields =  Array.from(event.srcElement.children);

        Object.keys(validation_rule).forEach((key)=>{

            let element = form_fields.filter((item)=>{
                return item.name == key;
            })[0];

            console.log(element);
            rules = validation_rule[element.name].split("|");            
            field_value = element.value; 
            let ele = document.querySelector(`#errors-${element.name}`);
            (ele) ? ele.innerHTML = '' : ''; 


            rules.forEach((rule) => {
                
                switch(rule) {

                    case 'required' :

                        if( field_value == undefined || field_value == ""){
                            errors[element.name] = `${element.name} is required`;
                            document.querySelector(`#errors-${element.name}`).innerHTML = errors[element.name];
                        }
                        break;
                    
                    case 'password' :
                        
                        if(! (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/.test(field_value))){
                            errors[element.name] = 'Invalid Password at least 8 digits including digits,character & Caps character';
                            document.querySelector(`#errors-${element.name}`).innerHTML = errors[element.name];

                        }

                        break;
                    
                    case 'email' :
 
                        if(! (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/).test(field_value)){
                            errors[element.name] = 'Invalid Email';
                            document.querySelector(`#errors-${element.name}`).innerHTML = errors[element.name];
                        }

                        break;

                    case 'nonumber':

                        if(/\d/.test(field_value)){
                            errors[element.name] = `Invalid ${element.name}`;
                            document.querySelector(`#errors-${element.name}`).innerHTML = errors[element.name];
                        }

                        break;

                    default:
                        break;
                }

            });            


        });


        if(Object.keys(errors).length ==  0)
            {
                event.target.submit();
            }


});
