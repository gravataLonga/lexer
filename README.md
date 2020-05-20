# Lexer  

For educational purpose, want to build my own programming language, i known that PHP isn't
the right tool for the job, give me a break ok?  

My language want to be like this:  
```js
variable = 10;
another_variable = 30;

// comment
echo variable + another_variable;

result = variable + another_variable;

if (result == 40) {
    echo "TRUE";
} else { 
    echo "FALSE";
}

// Basic structure  
map[variable] = "ola";

// Simple loops  
for(map in a => b) {
    echo a;
}


```   

We can do it? Maybe...  

* * *   

To do:  

 - [ ] tokenizer    
 - [ ] parser    
 - [ ] nodes  
 - [ ] compiler  