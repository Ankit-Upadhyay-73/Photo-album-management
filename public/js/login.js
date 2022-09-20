let validation_rule = {
    password    : "required|password",
    email       : "required|email"
}

let errors = {}; 

document.querySelector("form").addEventListener("submit",(event)=>{
        errors = {};
        event.preventDefault();
        let form_data = {};

        let form_fields = Array.from(event.srcElement.children);

        form_fields.forEach((element)=>{

            let field_value = (element.value);
            let rules = [];

            if (validation_rule[element.name] != undefined) {
                rules = validation_rule[element.name].split("|");
            }
            
            rules.forEach((rule) => {

                form_data[element.name] = field_value;

                switch(rule) {

                    case 'required' :
                        document.querySelector(`#errors-${element.name}`).innerHTML = '';                        
 
                        if( field_value == undefined || field_value == ""){
                            errors[element.name] = `${element.name} is required`;            

                            document.querySelector(`#errors-${element.name}`).innerHTML = errors[element.name];
                        }
                        break;
                    
                    case 'password' :
                        document.querySelector(`#errors-${element.name}`).innerHTML = '';                        

                        if(! (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/.test(field_value))){
                            errors[element.name] = 'Invalid Password';
                            document.querySelector(`#errors-${element.name}`).innerHTML = errors[element.name];
                        }
                        break;
                    
                    case 'email' :
                        document.querySelector(`#errors-${element.name}`).innerHTML = '';                        

                        if(! (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/).test(field_value)){

                            errors[element.name] = 'Invalid Email';

                            document.querySelector(`#errors-${element.name}`).innerHTML = errors[element.name];

                        }
                        break;

                    default:
                        break;
                }

            });

        });

    
    if(Object.keys(errors).length != 0)
        return errors;

    event.target.submit();
    

});