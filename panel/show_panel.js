async function show_panel() {
    let panelbody = await fetch('panel/index.html');
    let text = await panelbody.text();
    document.write(text)
}

// CORS ok
setInterval(parseXML, 60000);
async function parseXML()
{
    let rss = await fetch('panel/xml/getrss.php');
    let text = await rss.text();
    //console.log(xml);
    // parser xml
    parser = new DOMParser();
    xml = parser.parseFromString(text, "text/xml");
    document.getElementById("udalosti").textContent = "";
    
    let items = xml.getElementsByTagName("item");
    for (i = 0; i < items.length & i<25; i++) {
      let item = items[i];
      //console.log(item.innerHTML);
      //console.log(item);
      
      let novinka = (item.getElementsByTagName("title")[0].firstChild.data);
      let link = (item.getElementsByTagName("link")[0].firstChild.data);
      let div = document.createElement("div");
      let embed = document.createElement("a");
      embed.setAttribute("href",link);
      embed.setAttribute("target","_blank")
      let text = document.createTextNode(novinka);
      embed.appendChild(text);
      div.appendChild(embed);
      document.getElementById("udalosti").appendChild(div);

    }
}
  
document.body.addEventListener("load", parseXML());

