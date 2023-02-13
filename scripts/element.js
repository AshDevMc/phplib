function ElementNode(base, options)
{
    if(options.parent != undefined)
    {
        options.parent.insertBefore(base, options.parent.firstChild)
        delete options.parent;
    }

    if(options.preditor != undefined) //follows the children,
    {
        options.preditor.appendChild(base);
        delete options.preditor;
    }

    if(options.sibling != undefined)
    {
        options.sibling.parentNode.insertBefore(base, options.sibling)
        delete options.sibling;
    }
    
    
    if(typeof options.style == "object")
    {
        let keys =  Object.keys(options.style);
        
        for(let i=0; i<keys.length; i++)
        {
            base.style[keys[i]] = options.style[keys[i]];
        }
        delete options.style;
    }
    
}

function Element(options)
{
    if(typeof options != "object" || options.tagName == null)
    {
        console.error("options must be an object with atleast a tagname for example", {tagName:"div", id:"example69", classList:""});
        return;
    }


    let base = document.createElement(options.tagName);
    if( options.tagName.toLowerCase() == "template")
    {
        base.eventData = {dataParse: {data:null}};
        base.eventManager = { dataParse: new CustomEvent('dataParse', {detail: base.eventData.dataParse}) };
    }
    delete options.tagName;

    
    ElementNode.call(this, base, options);

    if(Array.isArray(options.classList))
    {
        for(let i=0; i<options.classList.length; i++)
        {
            base.classList.add(options.classList[i]);
        }
        delete options.classList;
    }
    else if(typeof options.classList == "string")
    {
        base.classList.add(options.classList);
        delete options.classList;
    }

    if(Array.isArray(options.attributes))
    {
        for(let i=0; i<options.attributes.length; i++)
        {
            let key = Object.keys(options.attributes[i])[0];
            let value = options.attributes[i][key];
            base.setAttribute(key, value);
        }
        delete options.attributes;
    }
    else if(typeof options.attributes == "object")
    {
        let keys =  Object.keys(options.attributes);
        
        for(let i=0; i<keys.length; i++)
        {
            base.setAttribute(keys[i], options.attributes[keys[i]]);
        }
        delete options.attributes;
    }

    if(Array.isArray(options.children))
    {
        for(let i=0; i<options.children.length; i++)
        {
            base.appendChild(options.children[i]);
        }
        delete options.children;
    }
    else if(options.children && options.children.nodeType)
    {
        base.appendChild(options.children);
    }
    

    let propertyKeys = Object.keys(options);
    for(let i=0; i<propertyKeys.length; i++)
    {
        base[propertyKeys] = options[propertyKeys];
    }

    base.removeAllChildren = function()
    {
        while(fc = base.firstChild)
            base.removeChild(fc);
    }

    return base;

}

function TextNode(value, options = {})
{
    let base = document.createTextNode(value);
    ElementNode.call(this, base, options);
    return base;
}