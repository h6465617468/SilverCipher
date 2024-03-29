class SC5 {
  constructor(key, digest=0, blocksize = 0, mode="string",error=false) {
    this.salt_1_dat = [0xdc, 0xc2, 0x81, 0xf2, 0x67, 0x59, 0xba, 0xe6, 0x58, 0x7c, 0xea, 0xbf, 0xe8, 0x8d, 0x95, 0x8b, 0x7c, 0x12, 0x17, 0x15, 0x50, 0x77, 0x5e, 0x13, 0x6c, 0x67, 0x17, 0x6f, 0x92, 0x95, 0x7c, 0x55, 0xb3, 0xb6, 0x05, 0xc6];
    this.salt_2_dat = [0x77, 0x9a, 0x82, 0x45, 0xc7, 0xa6, 0x7a, 0x85, 0xd4, 0x2a, 0x89, 0xad, 0xd5, 0x13, 0xd2, 0x16, 0x01, 0xb4, 0x2d, 0x3b, 0xa8, 0x8a, 0xe9, 0x00, 0x02, 0x59, 0x9f, 0x5f, 0x30, 0x93, 0x6c, 0xe4, 0x92, 0xb1, 0x60, 0x28];
    this.salt_st_dat = [0x01, 0xaa, 0xbb, 0xfa, 0xcc, 0xdd, 0xee, 0xff, 0x11, 0x22, 0x33, 0x44, 0x55, 0x66, 0x77, 0x88, 0x99, 0xaa, 0xbb, 0xcc, 0xdd, 0xee, 0xff, 0x11, 0x22, 0x33, 0x44, 0x55, 0x66, 0x77, 0x88, 0x99, 0xaa, 0xbb, 0xcc, 0xdd, 0xee, 0xff];
    this.hex_char = "abcdef0123456789";
    this.change_a = "864123b0ec7fd9a5";
    this.change_b = "fc3bd9a2678e5014";
    this.change_c = "53804edc67f1ba92";
    this.change_d = "9ca621fd74538e0b";
    this.change_e = "7c20fbe64d9351a8";
    this.change_f = "210f8eacd764b593";
    this.change_0 = "e7b8a246590c31df";
    this.change_1 = "28b5ae9cd430167f";
    this.change_2 = "17fc54839b062eda";
    this.change_3 = "d986c1f2ba04537e";
    this.change_4 = "34b78915d0ae26fc";
    this.change_5 = "5bef683092c1ad74";
    this.change_6 = "df9b3a41c76e2508";
    this.change_7 = "9374d21c50fe8b6a";
    this.change_8 = "60f931edc7b254a8";
    this.change_9 = "c17384b062ea95df";
    this.hashchan = "4f571ae30b9c2d68";
    this.hashchan1 = "94c37de51f80b6a2";
    this.hex_characters = "abcdef0123456789";
    this.sg="C1C2C3C4E1324412";
    this.base64_characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
    this.hex_1 = "549e30c67ba2f81d";
    this.hex_2 = "e326a51d04789fcb";
    this.hex_3 = "3bd45206fec9a718";
    this.hXc = "0132102013201203";
    this.hth_1 = "61fa2bed734890c5";
    this.rot13_1="v/Fpr29x0UjfHXoYmGO73LIDKulEaPgCdzN56Th8BqSsnRy4e1cW+tJQZVwAbkMi";
    this.rot13_2="sdk5qnN7MJITpwEUWfih8m0X91tYyC4eDAx2brOlHVgFK6u/ocP3a+zSjRvQZGBL";
    this.rot13_3="/hX2I5EbOmzxDJ9tK60aA3jV78YcqHMBQgUNZCWrRdveyswfSLun1FGpokPi4lT+";
    this.rot13_4="JuEnkzXo2lM5cadLfStT6s4R8j3rhp+NZWHixq9PCUQw0gOvFDeVGy/1AbBYmKI7";
    this.hash0 = "Lp2Pa9D+C7wF0Rt6ogmOzjncEQrTXhUZGiyS1f8B4/WHYNM3klsueAKVvIxJqb5d";
    this.hash1 = "257IF1i6SPaQXrsNYtwERHLUCZTxOjm9JclqzKuAkn0DVW4gMbGByv38/fdhpo+e";
    this.hash2 = "GzhwZ8MgP4k7l5RHaxAKu0vSFT9ycIn6EVm/NJief2qY+jsQUWbtoXL3pDrOBd1C";
    this.hash3 = "p40k9jRq786irIMoCWUn+uEeZaOhtyXgAL2dw5V1QvmbS3HYJGfxPDNFscKB/Tzl";
    this.hash4 = "HtigypvlBwSa94zkD5rPEUXMYR6LjdOJ+ueVF7on1h/3GfINmQWKTbCxq82Zsc0A";
    this.hash5 = "EfUAHgGCpohPNW47wkv+/dc6OrmbKSVzy0tj8M32La5RuIlqXeJQixsZ91TFYBnD";
    this.hash6 = "mTANO4zeudspRMXQxbPLV5Hi+GgW12Y/qDIrl3BUtjh9fov0wS6J7c8yknZCFEaK";
    this.hash7 = "IN4+2QL/UqthmjPKGRJvakdln6SAwObpVeE30szyDCi7Wuf8xgZc9BTHYX1rMFo5";
    this.hash8 = "oApR3+SPcLdJaOeVQmhN4F9BrKM267/wkyGXTUYDn8HvZxjitqECu0bgIszlf5W1";
    this.hash9 = "gVmZR0HGbx+OeskhAv2yLBW1fY5jF4dEulnMiP/Tp6JNqX8a93SoDQ7IrtcwUCKz";
    this.hasha = "VOW3M7gvdrxu5hYeFcz2jKoEt0UP9lNy4I1mnZsqaLCiAB6J+8RGpTQfXwkbDSH/";
    this.hashb = "08TjDklwrCpAgH7GsU3QIvBaREZOM+of/ni1XFyLVYxhPzW629t4JKSmuNbd5eqc";
    this.hashc = "D1396NtaIpQydChzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4gmTwZsfc0Jk";
    this.hashd = "3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2nctFdR9uXrpWJlCxGAsvBT/kzDwigNqP7LH";
    this.hashe = "hRa4QoBy5blILAusSC/YFXKr6qfpP92cN13TUvtZJxGWw0e+DOM7z8idVjHgEmkn";
    this.hashf = "fX+0wuaDgj4U8GKBHPF17ATq3vpmSV9ICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
    this.ax1xxxx=0;
    if (error === null || error === undefined || error === "") {
    this.error = false;
    } else {
    this.error = error;
    }
    if (key === null || key === undefined || key === "") {
    this.key = "123456789";
    } else {
    this.key = key;
    }
    if (mode === null || mode === undefined || mode === "") {
    this.mode = "string";
    } else {
    this.mode = mode;
    }
    if (!isNaN(digest)) {
      if (digest === null || digest === undefined  || digest === "") {
        this.digest=0;
      }else{
        if(isNaN(digest)){
          this.digest = digest;
        }else{
          this.digest = parseInt(digest);
        }
      }
    }else{
      this.digest=0;
    }
    if (!isNaN(blocksize)) {
      if (blocksize === null || blocksize === undefined  || blocksize === "") {
        this.blocksize=128;
      }else{
        if(parseInt(blocksize)>=128 && parseInt(blocksize)<256){
          this.blocksize = 128;
        }else if(parseInt(blocksize)>=256){
          this.blocksize = 256;
        }else if(parseInt(blocksize)<128){
          this.blocksize = 0;
        }else{
          if(isNaN(blocksize)){
            if(blocksize>=128 && blocksize<256){
              this.blocksize = 128;
            }if(blocksize>=256){
              this.blocksize = 256;
            }else{
              this.blocksize=0;
            }
          }else{
            if(parseInt(blocksize)>=128 && parseInt(blocksize)<256){
              this.blocksize = 128;
            }if(parseInt(blocksize)>=256){
              this.blocksize = 256;
            }else{
              this.blocksize=0;
            }
          }
        }
      }
    }else{
      this.blocksize=128;
    }
  }
  setblocksize(blocksize = 128){
    if (!isNaN(blocksize)) {
      if (blocksize === null || blocksize === undefined  || blocksize === "") {
        this.blocksize=128;
      }else{
        if(parseInt(blocksize)>=128 && parseInt(blocksize)<256){
          this.blocksize = 128;
        }else if(parseInt(blocksize)>=256){
          this.blocksize = 256;
        }else if(parseInt(blocksize)<128){
          this.blocksize = 0;
        }else{
          if(isNaN(blocksize)){
            if(blocksize>=128 && blocksize<256){
              this.blocksize = 128;
            }if(blocksize>=256){
              this.blocksize = 256;
            }else{
              this.blocksize=0;
            }
          }else{
            if(parseInt(blocksize)>=128 && parseInt(blocksize)<256){
              this.blocksize = 128;
            }if(parseInt(blocksize)>=256){
              this.blocksize = 256;
            }else{
              this.blocksize=0;
            }
          }
        }
      }
    }else{
      this.blocksize=128;
    }
  }
  setdigest(digest = 0){
    if (!isNaN(digest)) {
      if (digest === null || digest === undefined  || digest === "") {
        this.digest=0;
      }else{
        if(isNaN(digest)){
          this.digest = digest;
        }else{
          this.digest = parseInt(digest);
        }
      }
    }else{
      this.digest=0;
    }
  }
  setkey(key){
    if (key === null || key === undefined || key === "") {
    this.key = "123456789";
    } else {
    this.key = key;
    }
  }
  setmode(mode){
    if (mode === null || mode === undefined || mode === "") {
    this.mode = "string";
    } else {
    this.mode = mode;
    }
  }
  seterror(error){
    if (error === null || error === undefined || error === "") {
    this.error = false;
    } else {
    this.error = error;
    }
  }
  createPANEL(){
    var process_panel = document.getElementById("process_viewer_SC5_process_panel");
    if (process_panel) {
      var this_process = document.createElement ("div");
      var block = document.createElement ("div");
      var process = document.createElement ("div");
      block.style.fontSize = "36px";
      block.style.color = "#db3e3e";
      block.style.fontFamily = "'Roboto Slab',sans-serif";
      block.style.display = "block";
      block.style.marginTop = "10px";
      process.style.fontSize = "18px";
      process.style.color = "dimgrey";
      process.style.fontFamily = "'Roboto Slab',sans-serif";
      process.style.wordBreak = "break-word";
      process.style.display = "block";
      process.style.marginTop = "10px";
      this_process.appendChild (block);
      this_process.appendChild (process);
      process_panel.appendChild (this_process);
      return [process_panel,this_process,block,process];
    }
    var div = document.createElement ("div");
    div.id = "process_viewer_SC5_Panel";
    div.style.width = "320px";
    div.style.height = "auto";
    div.style.backgroundColor = "transparent";
    div.style.zIndex = "9999";
    div.style.position = "fixed";
    div.style.left = "50%";
    div.style.top = "50%";
    div.style.transform = "translate(-50%, -50%)";
    div.style.border = "2px solid salmon";
    div.style.borderRadius = "8px";
    div.style.fontSize = "36px";
    div.style.color = "#db3e3e";
    div.style.fontFamily = "'Roboto Slab',sans-serif";
    div.style.backdropFilter = "blur(4px)";
    div.style.textAlign = "center";
    div.style.padding = "5px";
    var logo = document.createElement ("img");
    logo.src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAC8ElEQVR4nO2ZW4hNURjHf2aMy7gO0QhDrrmlUWRCIsWDywMPg6JGlHjgZV6QiaYQuT3wYF4oE0UUUZLGRNFEI5OUZDAuTe7369aq/9RubOfs2zl7b51ffbVa6/vW+n/nsvZa34YcORLLMqCchDMJ+CWbQkLpANQDluy6+hLHciXwQmapL1EUAs0SXwGsUvsp0I0EsV3CbwF5spvq20ZCGAx8kugZtv4y4DfwGRhKAjipJI47jNVq7AQxZ5rtUx/iMD4I+KhkZhJT8oAGidyawq9KPreBfGLIGgl8kmZn6go8ku9qYkZP4LnEuTmOLJXvS6A3MWKPj6f3VcXsJiaMAL7qPDXZQ1ypYr4Do4kB5/XJHvERW6PYc0TMPAl5BxQ7jHcCimSm3Z5ixVqaKxIKgHsSUfkPny22069pO1GpcTOXmTPrbJSAB0DnNM8MS20nzDd1Xz4byDJ9gFdafGEKPzeJGBbJ5w3QjyxyWAtfTuPnNhHDRfkdIkuMA34AP4EJISYyVluxmXciWeCKhB1w4eslEcNB+dZn+lq8RAu9BvpmIJEioFX+i8kQXYCHWmSdyxiviRjWy79ZV+bQ2awFmjzs934SyQfuKGYTITMQ+KDJ53qI85OIYbZizJW5hBA5ponPeIzzm4jhrOKOEhJTdX39BozKYiLDdao2a08nIGYLvCEhO3zEB0nEsFOxDbpK+2alrVrYK4JEegDPFL8Cn3QHWmzVwiA7naW2HyoU3yJNnqkO4WstsN1HCkKozlR7DR4GfNEfzV4tjIoy24Yz0kvg6RTVwqiolaZTbgNmhfgwatt1jO0KOFeJraZsNKY9HjS6qBa6Za8tEdMOSpXmugt0TOW4Vo6PQzqwhZ1IobRZ0pr2CB3Wy0vz+mCOzKmo7YdyaWyV5r/YL4drCXjXVyet+9oPjNE102u1MCpKpdVcucfbBy4EqBZGRY00X2rrWKCO98AAkkN/4K20z0c3Pivh1mQv7yfZ6qL+eeT4b/kDXLNVbksXjZ8AAAAASUVORK5CYII=";
    var process_panel = document.createElement ("div");
    process_panel.id = "process_viewer_SC5_process_panel"
    var this_process = document.createElement ("div");
    var block = document.createElement ("div");
    var process = document.createElement ("div");
    block.style.fontSize = "36px";
    block.style.color = "#db3e3e";
    block.style.fontFamily = "'Roboto Slab',sans-serif";
    process.style.fontSize = "18px";
    process.style.color = "dimgrey";
    process.style.fontFamily = "'Roboto Slab',sans-serif";
    process.style.wordBreak = "break-word";
    div.appendChild (logo);
    this_process.appendChild (block);
    this_process.appendChild (process);
    process_panel.appendChild (this_process);
    div.appendChild (process_panel);
    document.body.prepend (div);
    return [process_panel,this_process,block,process];
  }
  writex(a1,a2){
    a1.innerHTML = a2;
    return true;
  }
  async asyncEncrypt (d) {
    var [process_panel,this_process,block,process] = [null,null,null];
    try{
      var [[a,a1,b,z,i,keylen,c,m],[k,g,h,rxa],[ax,e,f]]=[this.keygen0(d,"enc"),[1,1,1,1],["","",""]];
      try{
        let error = null;
        try{
          [process_panel,this_process,block,process] = await this.createPANEL();
        }catch(ex){error = true;}
        if(!error){
          var size = new TextEncoder().encode(d).length;
          var kiloBytes = size / 1024;
          this.writex(process,"Single Core Encrypt Process<br>Size:"+kiloBytes.toFixed(1) + " KB");
          this.writex(block,"0/"+m);
          let promise = new Promise((resolve, reject) => {
            let intervalID = setInterval(function () {
              if (process.innerHTML.length > 1  && block.innerHTML.length > 1) {
                clearInterval(intervalID);
                resolve();
              }
            }, 10);
          });
          await promise;
        }
      }catch(e){}
      for(var l of i){
        await new Promise(r => setTimeout(r, 1));
        [a,a1,b,f,keylen,k,m,c,h,g,e,ax,l,z,i] = this.epart0(a,a1,b,f,keylen,k,m,c,h,g,e,ax,l,z,i);
        try{
          this.writex(block,rxa+"/"+m);
          await new Promise(r => setTimeout(r, 1));
          rxa++;
        }catch(e){}
        await new Promise(r => setTimeout(r, 1));
      }
      e+="==";
      if((this_process) && (process_panel)){
        this_process.remove();
        if (!process_panel.hasChildNodes()) {
          process_panel.parentNode.remove();
        }
      }
      return e;
    }catch(ex){
      if((this_process) && (process_panel)){
        this_process.remove();
        if (!process_panel.hasChildNodes()) {
          process_panel.parentNode.remove();
        }
      }
      if(this.error==false){return "";}{
        throw new Error('asyncEncrypt Error:'+ex);
      }
    }
  }
  async asyncDecrypt (e) {
    var [process_panel,this_process,block,process] = [null,null,null];
    try{
      e = e.replace(/ /g, "").trim().replace(/=/g, "");
      var [[a,a1,b,z,h,keylen,c,n],[l,f,g,rxa],[d,ax,i],[ixa1k]] = [this.keygen0(e,"dec"),[1,1,1,1],["","",""],[0]];
      try{
        let error = null;
        try{
          [process_panel,this_process,block,process] = await this.createPANEL();
        }catch(ex){error = true;}
        if(!error){
          var size = new TextEncoder().encode(e).length;
          var kiloBytes = size / 1024;
          this.writex(process,"Single Core Decrypt Process<br>Size:"+kiloBytes.toFixed(1) + " KB");
          this.writex(block,"0/"+n);
          let promise = new Promise((resolve, reject) => {
            let intervalID = setInterval(function () {
              if (process.innerHTML.length > 1  && block.innerHTML.length > 1) {
                clearInterval(intervalID);
                resolve();
              }
            }, 10);
          });
          await promise;
        }
      }catch(e){}
      for(var m of h){
        await new Promise(r => setTimeout(r, 1));
        [b,a1,i,keylen,l,n,c,ax,g,a,f,m,z,d,ixa1k,h] = this.dpart0(b,a1,i,keylen,l,n,c,ax,g,a,f,m,z,d,ixa1k,h);
        try{
          this.writex(block,rxa+"/"+n);
          await new Promise(r => setTimeout(r, 1));
          rxa++;
        }catch(e){}
        await new Promise(r => setTimeout(r, 1));
      }
      d = this.dend0(d);
      if((this_process) && (process_panel)){
        this_process.remove();
        if (!process_panel.hasChildNodes()) {
          process_panel.parentNode.remove();
        }
      }
      return d;
    }catch(ex){
      if((this_process) && (process_panel)){
        this_process.remove();
        if (!process_panel.hasChildNodes()) {
          process_panel.parentNode.remove();
        }
      }
      if(this.error==false){return "";}{
        throw new Error('asyncDecrypt Error:'+ex);
      }
    }
  }
  WP(){
    var h=10,u=[],w=[],q,p,B,v,A,f,e,b,a,G,F,s="\u1823\uc6E8\u87B8\u014F\u36A6\ud2F5\u796F\u9152\u60Bc\u9B8E\uA30c\u7B35\u1dE0\ud7c2\u2E4B\uFE57\u1577\u37E5\u9FF0\u4AdA\u58c9\u290A\uB1A0\u6B85\uBd5d\u10F4\ucB3E\u0567\uE427\u418B\uA77d\u95d8\uFBEE\u7c66\udd17\u479E\ucA2d\uBF07\uAd5A\u8333\u6302\uAA71\uc819\u49d9\uF2E3\u5B88\u9A26\u32B0\uE90F\ud580\uBEcd\u3448\uFF7A\u905F\u2068\u1AAE\uB454\u9322\u64F1\u7312\u4008\uc3Ec\udBA1\u8d3d\u9700\ucF2B\u7682\ud61B\uB5AF\u6A50\u45F3\u30EF\u3F55\uA2EA\u65BA\u2Fc0\udE1c\uFd4d\u9275\u068A\uB2E6\u0E1F\u62d4\uA896\uF9c5\u2559\u8472\u394c\u5E78\u388c\ud1A5\uE261\uB321\u9c1E\u43c7\uFc04\u5199\u6d0d\uFAdF\u7E24\u3BAB\ucE11\u8F4E\uB7EB\u3c81\u94F7\uB913\u2cd3\uE76E\uc403\u5644\u7FA9\u2ABB\uc153\udc0B\u9d6c\u3174\uF646\uAc89\u14E1\u163A\u6909\u70B6\ud0Ed\ucc42\u98A4\u285c\uF886";for(q=8;q-->0;){u[q]=[]}
    for(p=0;p<256;p++){B=s.charCodeAt(p/2);f=((p&1)==0)?B>>>8:B&255;e=f<<1;if(e>=256){e^=285}
    b=e<<1;if(b>=256){b^=285}
    a=b^f;G=b<<1;if(G>=256){G^=285}
    F=G^f;u[0][p]=[0,0];u[0][p][0]=(f<<24)|(f<<16)|(b<<8)|(f);u[0][p][1]=(G<<24)|(a<<16)|(e<<8)|(F);for(var q=1;q<8;q++){u[q][p]=[0,0];u[q][p][0]=(u[q-1][p][0]>>>8)|((u[q-1][p][1]<<24));u[q][p][1]=(u[q-1][p][1]>>>8)|((u[q-1][p][0]<<24))}}
    w[0]=[0,0];for(v=1;v<=h;v++){A=8*(v-1);w[v]=[0,0];w[v][0]=(u[0][A][0]&4278190080)^(u[1][A+1][0]&16711680)^(u[2][A+2][0]&65280)^(u[3][A+3][0]&255);w[v][1]=(u[4][A+4][1]&4278190080)^(u[5][A+5][1]&16711680)^(u[6][A+6][1]&65280)^(u[7][A+7][1]&255)}
    let z=[],y=[],d=[],o=[],m=[],l=[],g=[],n=0,j=0;function E(){let C,c,I,H,x;for(C=0,c=0;C<8;C++,c+=8){l[C]=[0,0];l[C][0]=((y[c]&255)<<24)^((y[c+1]&255)<<16)^((y[c+2]&255)<<8)^((y[c+3]&255));l[C][1]=((y[c+4]&255)<<24)^((y[c+5]&255)<<16)^((y[c+6]&255)<<8)^((y[c+7]&255))}
    for(C=0;C<8;C++){g[C]=[0,0];o[C]=[0,0];g[C][0]=l[C][0]^(o[C][0]=d[C][0]);g[C][1]=l[C][1]^(o[C][1]=d[C][1])}
    for(I=1;I<=h;I++){for(C=0;C<8;C++){m[C]=[0,0];for(x=0,H=56,c=0;x<8;x++,H-=8,c=H<32?1:0){m[C][0]^=u[x][(o[(C-x)&7][c]>>>(H%32))&255][0];m[C][1]^=u[x][(o[(C-x)&7][c]>>>(H%32))&255][1]}}
    for(C=0;C<8;C++){o[C][0]=m[C][0];o[C][1]=m[C][1]}
    o[0][0]^=w[I][0];o[0][1]^=w[I][1];for(C=0;C<8;C++){m[C][0]=o[C][0];m[C][1]=o[C][1];for(x=0,H=56,c=0;x<8;x++,H-=8,c=H<32?1:0){m[C][0]^=u[x][(g[(C-x)&7][c]>>>(H%32))&255][0];m[C][1]^=u[x][(g[(C-x)&7][c]>>>(H%32))&255][1]}}
    for(C=0;C<8;C++){g[C][0]=m[C][0];g[C][1]=m[C][1]}}
    for(C=0;C<8;C++){d[C][0]^=g[C][0]^l[C][0];d[C][1]^=g[C][1]^l[C][1]}};function k(r){let c,x,t=r.toString();r=[];for(c=0;c<t.length;c++){x=t.charCodeAt(c);if(x>=256){r.push(x>>>8&255)}
    r.push(x&255)}
    return r};const enc={init:function(){for(var c=32;c-->0;){z[c]=0}
    n=j=0;y=[0];for(c=8;c-->0;){d[c]=[0,0]}
    return enc},add:function(c){if(!c){return enc}
    c=k(c);let K=c.length*8,r=0,t=(8-(K&7))&7,C=n&7,x,H,J,I=K;for(x=31,J=0;x>=0;x--){J+=(z[x]&255)+(I%256);z[x]=J&255;J>>>=8;I=Math.floor(I/256)}
    while(K>8){H=((c[r]<<t)&255)|((c[r+1]&255)>>>(8-t));y[j++]|=H>>>C;n+=8-C;if(n==512){E();n=j=0;y=[]}
    y[j]=((H<<(8-C))&255);n+=C;K-=8;r++}
    if(K>0){H=(c[r]<<t)&255;y[j]|=H>>>C}else{H=0}
    if(C+K<8){n+=K}else{j++;n+=8-C;K-=8-C;if(n==512){E();n=j=0;y=[]}
    y[j]=((H<<(8-C))&255);n+=K}
    return enc},finalize:function(){let r,c,t,H="",C=[],x="0123456789ABCDEF".split("");y[j]|=128>>>(n&7);j++;if(j>32){while(j<64){y[j++]=0}
    E();j=0;y=[]}
    while(j<32){y[j++]=0}
    y.push.apply(y,z);E();for(r=0,c=0;r<8;r++,c+=8){t=d[r][0];C[c]=t>>>24&255;C[c+1]=t>>>16&255;C[c+2]=t>>>8&255;C[c+3]=t&255;t=d[r][1];C[c+4]=t>>>24&255;C[c+5]=t>>>16&255;C[c+6]=t>>>8&255;C[c+7]=t&255}
    for(r=0;r<C.length;r++){H+=x[C[r]>>>4];H+=x[C[r]&15]}
    return H.toLowerCase();}}
    function h2b(str){let hexString=str,strOut='';for(var x=0;x<hexString.length;x+=2){strOut+=String.fromCharCode(parseInt(hexString.substr(x,2),16));}
    return strOut;}
    function hex2Uint(hex,buf){
    let view=new Uint8Array(hex.length/2)
    for(var i=0;i<hex.length;i+=2){view[i/2]=parseInt(hex.substring(i,i+2),16)}
    if(buf){return view.buffer}
    return view}
    function h2b64(hex){return btoa(hex.match(/\w{2}/g).map(function(a){return String.fromCharCode(parseInt(a,16));}).join(""));}
    let res;const Whirlpool={encSync:function(i,digest){if(!i||typeof i!=='string'||i===''){return null}
    res=enc.init().add(i).finalize()
    if(!digest||digest.toLowerCase()==='hex'){return res}
    if(digest.toLowerCase()==='bytes'){return h2b(res);}
    if(digest.toLowerCase()==='base64'){return h2b64(res);}
    if(digest.toLowerCase()==='uint8'){return hex2Uint(res,false);}
    if(digest.toLowerCase()==='arraybuffer'){return hex2Uint(res,true);}},enc:function(i,digest,cb){if(typeof digest=='function'){cb=digest
    return}
    if(typeof i!=='string'||i===''){cb('whirlpool input must be a string',null)
    return}
    try{res=enc.init().add(i).finalize();if(typeof disgest==='function'||digest.toLowerCase()==='hex'){cb(false,res);}
    if(digest.toLowerCase()==='bytes'){cb(false,h2b(res));}
    if(digest.toLowerCase()==='base64'){cb(false,h2b64(res));}
    if(digest.toLowerCase()==='uint8'){cb(false,hex2Uint(res,false));}
    if(digest.toLowerCase()==='arraybuffer'){cb(false,hex2Uint(res,true));}}catch(err){cb(err,null);}},encP:function(i,digest){return new Promise(function(resolve,reject){if(!i||typeof i!=='string'||i===''){reject('whirlpool input must be a string');}
    try{res=enc.init().add(i).finalize();if(!digest||digest.toLowerCase()==='hex'){resolve(res);}
    if(digest.toLowerCase()==='bytes'){resolve(h2b(res));}
    if(digest.toLowerCase()==='base64'){resolve(h2b64(res));}
    if(digest.toLowerCase()==='uint8'){resolve(hex2Uint(res,false));}
    if(digest.toLowerCase()==='arraybuffer'){resolve(hex2Uint(res,true));}
    return;}catch(err){reject(err);}})}}
    return Whirlpool;
  }
  base64_encode(array) {
    var base64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
    var result = '';
    var i, j, triplet;
  
    for (i = 0; i < array.length; i += 3) {
      triplet = (array[i] << 16) | (array[i + 1] << 8) | array[i + 2];
      for (j = 0; j < 4; j += 1) {
        if (i * 8 + j * 6 <= array.length * 8) {
          result += base64.charAt((triplet >> 18 - j * 6) & 0x3F);
        }
      }
    }
    return result;
  }
  base64_decode(str) {
    let buffer = [];
    let bits = 0;
    let value = 0;
    let index = 0;
    for (let i = 0; i < str.length; i++) {
      const charCode = str.charCodeAt(i);
      let digit = charCode > 64 && charCode < 91 ? charCode - 65
        : charCode > 96 && charCode < 123 ? charCode - 71
        : charCode > 47 && charCode < 58 ? charCode + 4
        : charCode === 43 ? 62
        : charCode === 47 ? 63
        : -1;
      if (digit !== -1) {
        value = (value << 6) | digit;
        bits += 6;
        if (bits >= 8) {
          buffer[index++] = (value >> (bits - 8)) & 255;
          bits -= 8;
        }
      }
    }
    return new Uint8Array(buffer);
  }
  adler32(message) {
    const MOD_ADLER = 65521;
    let a = 1, b = 0;
    
    for (let i = 0; i < message.length; i++) {
      a = (a + message.charCodeAt(i)) % MOD_ADLER;
      b = (b + a) % MOD_ADLER;
    }
    
    return ((b << 16) | a).toString(16).padStart(8, '0').replace(/-/g, "");
  }
  strtr(text,textstring, replace_pairs) {
    let b = textstring;
    let c = replace_pairs;
    let d = text.replace(/[A-Za-z0-9+/=]/g, m => c[b.indexOf(m)]);
    return d;
  }
  str_split(str, length) {
    // str parametresinin tipini bir değişkene kaydet
    var inputType = typeof str;
    // eğer girdi bir number ise, onu bir Uni8Array'e dönüştür
    if (inputType == "number") {
      // sayıyı bir dizgeye dönüştür
      var strNum = str.toString();
      // dizgeyi bir Uni8Array'e dönüştür
      str = new Uint8Array(strNum.length);
      // dizgenin her elemanını sayıya dönüştürerek Uni8Array'e atayın
      for (var i = 0; i < strNum.length; i++) {
      str[i] = parseInt(strNum[i]);
      }
    }
    // eğer girdi bir Uni8Array ise, onu bir dizgeye dönüştür
    // if (str instanceof Uint8Array) {
    //  str = String.fromCharCode.apply(null, str);
    // }
    // düzenli ifadeyi oluştur
    // var regex = new RegExp("(.{1," + length + "})", "gms");

    // // match() fonksiyonu ile dizgeyi düzenli ifadeye göre eşleştiren bir dizi elde et
    // var result = str.match(regex);
    if (typeof str === "string") {
      str = this.StringTouint8Array(str);
    }
    var result = [];
    var decoder = new TextDecoder("utf-8"); // string'e dönüştürmek için decoder

    var uint8array = str;
    for (var i = 0; i < uint8array.length; i += length) {
      var subarray = uint8array.slice(i, i + length); // uni8array'i istenen uzunlukta bölüyor
      if (inputType == "object" || inputType == "number") {
        var str = subarray;
      }else{
        var str = decoder.decode(subarray); // subarray'i string'e çeviriyor
      }
      
      result.push(str); // sonuç dizisine ekliyor
    }

    // eğer sonuç null ise, girdiyi bir diziye dönüştür
    if (subarray == null) {
      result = [str];
    }
    // sonucu döndür
    return result;
  }
  split_block(str,blocksize) {
      // Check if the input is a valid Uint8Array
      if (!(str instanceof Uint8Array)) {
        throw new TypeError('Input must be a Uint8Array');
      }
      // Define the block size
      const length = blocksize;
      // Initialize an array to store the output
      var result = [];
      // Loop through the input
      for (var i = 0; i < str.length; i += length) {
        // Get the slice of the input corresponding to the current block
        var subarray = str.slice(i, i + length);
        // Pad or slice the subarray to make it exactly blocksize bytes long
        subarray = subarray.length < blocksize ? new Uint8Array([...subarray, ...new Array(blocksize - subarray.length).fill(0)]) : subarray;
        // Add the subarray to the output array
        result.push(subarray);
      }
      // Return the output array
      return result;
  }
  removeEmptyBytes(array) {
    // Check if the input is a valid Uint8Array
    if (!(array instanceof Uint8Array)) {
      throw new TypeError('Input must be a Uint8Array');
    }
    // Filter the array by non-zero values
    var filtered = array.filter(x => x !== 0);
    // Return the filtered array
    return filtered;
  }
  strrev(str) {
    // parametrenin türünü kontrol et
    if (typeof str === "string") {
      // yeni bir dizge oluştur
      var res = "";
      // son karakterden başlayarak dizgenin her karakterini ekle
      for (var i = str.length - 1; i >= 0; i--) {
        res += str[i];
      }
      // sonucu döndür
      return res;
    } else if (str instanceof Uint8Array) {
      // yeni bir Uint8Array oluştur
      var res = new Uint8Array(str.length);
      // son elemandan başlayarak dizinin her elemanını kopyala
      for (var i = 0; i < str.length; i++) {
        res[i] = str[str.length - 1 - i];
      }
      // sonucu döndür
      return res;
    } else {
      // hata fırlat
      throw new Error("Invalid parameter type");
    }
  }
  CharCodeToUint8Array(hex) {
    var str = String.fromCharCode(hex);
  
    // Convert the string to a Uint8Array using the TextEncoder class
    var encoder = new TextEncoder();
    var arr = encoder.encode(str);
  
    // Return the Uint8Array
    return arr;
  }
  uint8ArrayToString(uint8Array) {
      return new TextDecoder().decode(uint8Array);
  }
  StringTouint8Array(str) {
      return new TextEncoder().encode(str);
  }
  hex2bin(hexString) {
    if (typeof hexString !== "string") {
      // hata fırlat veya başka bir işlem yap
      throw new TypeError("hexString must be a string");
    }
    // hexString'in uzunluğunu kontrol et
    if (hexString.length % 2 !== 0) {
      // Uzunluk tek ise başına sıfır ekle
      hexString = "0" + hexString;
    }
    var length = hexString.length / 2;
    var uint8Array = new Uint8Array(length);
    for (let i = 0; i < length; ++i) {
      // Her iki karakteri al ve 16 tabanında sayıya dönüştür
      uint8Array[i] = parseInt(hexString.substr(i * 2, 2), 16);
    }
    return uint8Array;
  }
  bin2hex(uint8Array) {
      let hexString = "";
      for (let i = 0; i < uint8Array.length; i++) {
          let hex = uint8Array[i].toString(16).padStart(2, "0");
          hexString += hex;
      }
      return hexString;
  }
  substr(str, start, length) {
    try{
    if (typeof str == "number") {
      str = str.toString();
    }
    // parametrelerin türünü kontrol et
    if (typeof str !== "string") {
      throw new Error("Invalid string parameter");
    }
    if (typeof start !== "number") {
      throw new Error("Invalid start parameter");
    }
    if (length !== undefined && typeof length !== "number") {
      throw new Error("Invalid length parameter");
    }
    // eğer başlangıç indeksi negatifse, dizge uzunluğuna ekle
    if (start < 0) {
      start = str.length + start;
    }
    // eğer uzunluk verilmediyse veya negatifse, dizge uzunluğunu kullan
    if (length === undefined || length < 0) {
      length = str.length;
    }
    // başlangıç indeksinden verilen uzunlukla dizgeyi kes
    return str.slice(start, start + length);
  } catch (e) {
    return str;
  }
  }
  md5(data, asUint8Array = false){
    if (data instanceof Uint8Array) {
      var decoder = new TextDecoder();
      var data = decoder.decode(data);
    }
    var result = CryptoJS.MD5(data).toString(CryptoJS.enc.Hex); // get the MD5 hash of data as a hex string
    if (asUint8Array) {
      // convert the result to a Uint8Array
      var resultLength = result.length / 2; // the length of the Uint8Array is half the length of the hex string
      var resultUint8 = new Uint8Array(resultLength); // create a new Uint8Array with the result length
      for (var i = 0; i < resultLength; i++) {
        // get the hex value of each pair of characters in the result
        var hex = result.substring(i * 2, i * 2 + 2);
        // convert the hex value to a decimal value
        var dec = parseInt(hex, 16);
        // set the decimal value to the corresponding index in the Uint8Array
        resultUint8[i] = dec;
      }
      // return the Uint8Array
      return resultUint8;
    }
    else {
      // return the result as a string
      return result;
    }
  }
  sha1(data, asUint8Array = false){
    if (data instanceof Uint8Array) {
      var decoder = new TextDecoder();
      var data = decoder.decode(data);
    }
    var result = CryptoJS.SHA1(data).toString(CryptoJS.enc.Hex); // get the SHA1 hash of data as a hex string
    if (asUint8Array) {
      // convert the result to a Uint8Array
      var resultLength = result.length / 2; // the length of the Uint8Array is half the length of the hex string
      var resultUint8 = new Uint8Array(resultLength); // create a new Uint8Array with the result length
      for (var i = 0; i < resultLength; i++) {
        // get the hex value of each pair of characters in the result
        var hex = result.substring(i * 2, i * 2 + 2);
        // convert the hex value to a decimal value
        var dec = parseInt(hex, 16);
        // set the decimal value to the corresponding index in the Uint8Array
        resultUint8[i] = dec;
      }
      // return the Uint8Array
      return resultUint8;
    }
    else {
      // return the result as a string
      return result;
    }
  }
  hash(algo, data) {
    if (data instanceof Uint8Array) {
      var decoder = new TextDecoder();
      var data = decoder.decode(data);
    }
    switch (algo) {
      case 'whirlpool':
        var result = this.WP().encSync(data, 'hex');
        return result;
        break;
      case 'sha512':
        // crypto-js kütüphanesinin SHA512 algoritmasını kullan
        var result = CryptoJS.SHA512(data).toString(CryptoJS.enc.Hex);
        return result;
        break;
      case 'sha256':
        // crypto-js kütüphanesinin SHA256 algoritmasını kullan
        var result = CryptoJS.SHA256(data).toString(CryptoJS.enc.Hex);
        return result;
        break;
      // ...
      default:
        // Throw an error if the algorithm is not supported
        throw new Error('Unsupported algorithm: ' + algo);
    }
  }
  hash_uni8array(algo, data) {
    switch (algo) {
      case 'whirlpool':
        var result = this.WP().encSync(data, 'hex');
        // sonucu Uint8Array olarak dönüştür
        var bytes = Buffer.from(result, 'hex');
        var array = new Uint8Array(bytes.words.length * 4);
        for (var i = 0; i < bytes.words.length; i++) {
          array[i * 4] = (bytes.words[i] & 0xff000000) >>> 24;
          array[i * 4 + 1] = (bytes.words[i] & 0x00ff0000) >>> 16;
          array[i * 4 + 2] = (bytes.words[i] & 0x0000ff00) >>> 8;
          array[i * 4 + 3] = (bytes.words[i] & 0x000000ff);
        }
        return array;

        break;
      case 'sha512':
        // crypto-js kütüphanesinin SHA512 algoritmasını kullan
        var result = CryptoJS.SHA512(data).toString(CryptoJS.enc.Hex);
        // sonucu Uint8Array olarak dönüştür
        var bytes = CryptoJS.enc.Hex.parse(result);
        var array = new Uint8Array(bytes.words.length * 4);
        for (var i = 0; i < bytes.words.length; i++) {
          array[i * 4] = (bytes.words[i] & 0xff000000) >>> 24;
          array[i * 4 + 1] = (bytes.words[i] & 0x00ff0000) >>> 16;
          array[i * 4 + 2] = (bytes.words[i] & 0x0000ff00) >>> 8;
          array[i * 4 + 3] = (bytes.words[i] & 0x000000ff);
        }
        return array;
        break;
      case 'sha256':
        // crypto-js kütüphanesinin SHA256 algoritmasını kullan
        var result = CryptoJS.SHA256(data).toString(CryptoJS.enc.Hex);
        // sonucu Uint8Array olarak dönüştür
        var bytes = CryptoJS.enc.Hex.parse(result);
        var array = new Uint8Array(bytes.words.length * 4);
        for (var i = 0; i < bytes.words.length; i++) {
          array[i * 4] = (bytes.words[i] & 0xff000000) >>> 24;
          array[i * 4 + 1] = (bytes.words[i] & 0x00ff0000) >>> 16;
          array[i * 4 + 2] = (bytes.words[i] & 0x0000ff00) >>> 8;
          array[i * 4 + 3] = (bytes.words[i] & 0x000000ff);
        }
        return array;
        break;
      // ...
      default:
        // Throw an error if the algorithm is not supported
        throw new Error('Unsupported algorithm: ' + algo);
    }
  }
  fix (x) {
    // check if x is already a Uint8Array
    if (x instanceof Uint8Array) {
    return x; // no need to fix
    }
    // check if x is an object
    if (Object.prototype.toString.call(x) === "[object Object]") {
    // convert x to a Uint8Array using TextEncoder
    var string = JSON.stringify(x); // convert x to a string
    var encoder = new TextEncoder(); // create a TextEncoder object
    var y = encoder.encode(string); // encode the string to a Uint8Array
    return y; // return the fixed Uint8Array
    }
    // try to convert x to a Uint8Array
    try {
    var y = new Uint8Array(x); // this may throw an error if x is not convertible
    return y; // return the fixed Uint8Array
    }
    catch (error) {
    // x is not convertible to a Uint8Array
    throw new Error("Cannot fix x: " + error.message); // throw an error with a message
    }
  }
  openssl_random_pseudo_bytes(length) {
    // geçerli bir uzunluk kontrolü yap
    if (length < 1 || length > 65536) {
      throw new Error("Invalid length");
    }
    // belirtilen uzunlukta bir Uint8Array oluştur
    var bytes = new Uint8Array(length);
    // diziyi rastgele baytlarla doldur
    for (var i = 0; i < length; i++) {
      // 0 ile 255 arasında rastgele bir tam sayı üret
      var randomByte = Math.floor(Math.random() * 256);
      // dizinin i. elemanına ata
      bytes[i] = randomByte;
    }
    // diziyi döndür
    return bytes;
  }
  convert (charCodes) {
    // create an empty array to store the Uint8Arrays
    var result = [];
    // loop through the charCodes array
    for (var i = 0; i < charCodes.length; i++) {
      // get the current charCode
      var charCode = charCodes[i];
      // convert it to a Uint8Array using this.CharCodeToUint8Array()
      var uint8 = this.CharCodeToUint8Array(charCode);
      // push the Uint8Array to the result array
      result.push(uint8);
    }
    // create a single Uint8Array from the result array
    var resultLength = 0; // the total length of the result
    for (var i = 0; i < result.length; i++) {
      resultLength += result[i].length; // add the length of each Uint8Array
    }
    var resultUint8 = new Uint8Array(resultLength); // create a new Uint8Array with the total length
    var offset = 0; // the current offset in the resultUint8
    for (var i = 0; i < result.length; i++) {
      resultUint8.set(result[i], offset); // copy each Uint8Array to the resultUint8
      offset += result[i].length; // update the offset
    }
    
    // return the single Uint8Array
    return resultUint8;
  }
  generateKeys(k, n) {
    // Parametrelerin tiplerini kontrol edelim
    if (typeof k === "string" && typeof n === "number") {
      k = this.uint8ArrayToString(this.swapPairs(this.shiftRight(this.bitShiftRight(this.hex2bin(CryptoJS.SHA512(k).toString())))));
      // Key değerlerini tutacak bir array tanımlayalım
      let keys = [];
      // n kadar round yapalım
      for (let i = 0; i < n; i++) {
        // k parametresi için formülleri uygulayalım
        var t = this.hex2bin(this.Hex_Dont_Count (this.hash("sha512", this.md5(k))));
        t = this.bitShiftLeft(t);
        var f = this.Hex_Dont_Count (this.hash("sha512", f + t + this.convert(0x3f,0x6c,0x33)));
        var l = this.Raw_hexrev (this.hex2bin(this.Hex_Dont_Count (this.hash("sha512", f))));
        l = this.bitShiftRight(l);
        var q = this.Raw_hexrev (this.hex2bin(this.Hex_Dont_Count (this.hash("whirlpool", this.uint8ArrayToString(this.hex2bin(this.E_hex_1 (f)))))));
        q = this.bitShiftLeft(q);
        var m = this.hex2bin(this.Hex_Dont_Count (this.hash("whirlpool", this.uint8ArrayToString(this.hex2bin(this.md5 (this.XOREncrypt(this.hex2bin(f), q)))))));
        m = this.bitShiftRight(m);
        var g = this.hashtoXcode(f);
        var o = this.hex2bin(this.Hex_Dont_Count (this.hash("sha512", this.uint8ArrayToString(this.Raw_hexrev (this.StringTouint8Array(Math.exp (Math.pow (2, 2))) + this.XOREncrypt(l, k))))));
        o = this.bitShiftLeft(o);
        var p = this.hex2bin(this.Hex_Dont_Count (this.hash("sha512", this.uint8ArrayToString(this.hex2bin(this.hash("whirlpool", q))))));
        p = this.bitShiftRight(p);

        // Elde edilen değerleri bir array olarak tutalım
        var key = [t, f, l, q, m, g, o, p];
  
        // Key değerini arraye ekleyelim
        keys.push(key);
  
        // k parametresini CryptoJS SHA512 ile güncelleyelim
        k = this.uint8ArrayToString(this.swapPairs(this.shiftLeft(this.bitShiftRight(this.hex2bin(CryptoJS.SHA512(k).toString())))));
      }
      // Key değerlerini döndürelim
      return keys;
    } else {
      // Geçersiz parametre hatası verelim
      console.error("Parametreler bir string ve bir sayı olmalıdır.");
    }
  }
  Eadd(array, add) {
    add = add % 256; // Toplama miktarını 256'nın modunu al
    let result = Uint8Array.from(array, num => (num + add) & 255); // Her değeri topla ve 8 bitlik sınırı koru
    return result;
  }
  Dadd(array, add) {
    add = add % 256; // Toplama miktarını 256'nın modunu al
    let result = Uint8Array.from(array, num => (num - add) & 255); // Her değerden çıkar ve 8 bitlik sınırı koru
    return result;
  }
  EaddX(array) {
  let result = new Uint8Array(array.length); // Sonuç için yeni bir Uint8Array oluştur
  for (let i = 0; i < array.length; i++) {
    // Her değeri sırası kadar topla ve 8 bitlik sınırı koru
    result[i] = (array[i] + i) & 255;
  }
  return result;
  }
  DaddX(array) {
    let result = new Uint8Array(array.length); // Sonuç için yeni bir Uint8Array oluştur
    for (let i = 0; i < array.length; i++) {
      // Her değerden sırasını çıkar ve 8 bitlik sınırı koru
      result[i] = (array[i] - i) & 255;
    }
    return result;
  }
  swapPairs(array) {
      // array'in uzunluğu tek ise son elemanı atla
      let limit = array.length;
      if (array.length % 2 == 1) {
        limit = array.length - 1;
      }
      // array'in uzunluğunun çift veya tek olduğunu varsayalım
      for (let i = 0; i < limit; i += 2) {
        // i ve i+1. elemanları yer değiştir
        let temp = array[i];
        array[i] = array[i+1];
        array[i+1] = temp;
      }
      return array;
  }
  shiftRight(array, times=1) {
    // Check if the input is a valid Uint8Array
    if (!(array instanceof Uint8Array)) {
      throw new TypeError('Input must be a Uint8Array');
    }
    // Check if the times is a valid number
    if (typeof times !== 'number' || isNaN(times) || times < 0) {
      throw new TypeError('Times must be a positive number');
    }
    // Reduce the times by the array's length modulo
    times = times % array.length;
    // Create a new Uint8Array to store the output
    let output = new Uint8Array(array.length);
    // Loop through the array
    for (let i = 0; i < array.length; i++) {
      // Calculate the shifted index
      let j = (i + times) % array.length;
      // Assign the output element to the array element
      output[j] = array[i];
    }
    // Return the output array
    return output;
  }
  shiftLeft(array, times=1) {
    // Check if the input is a valid Uint8Array
    if (!(array instanceof Uint8Array)) {
      throw new TypeError('Input must be a Uint8Array');
    }
    // Check if the times is a valid number
    if (typeof times !== 'number' || isNaN(times) || times < 0) {
      throw new TypeError('Times must be a positive number');
    }
    // Reduce the times by the array's length modulo
    times = times % array.length;
    // Create a new Uint8Array to store the output
    let output = new Uint8Array(array.length);
    // Loop through the array
    for (let i = 0; i < array.length; i++) {
      // Calculate the shifted index
      let j = (i - times + array.length) % array.length;
      // Assign the output element to the array element
      output[j] = array[i];
    }
    // Return the output array
    return output;
  }
  bitShiftRight(array) {
    // array'in son elemanının en düşük bitini al
    let lastBit = array[array.length - 1] & 1;
    // array'in her elemanını sağa doğru bir bit kaydır
    for (let i = 0; i < array.length; i++) {
      // elemanın en yüksek bitini kaybetmemek için sakla
      let highBit = array[i] & 128;
      // elemanı sağa doğru bir bit kaydır
      array[i] = array[i] >>> 1;
      // elemanın en yüksek bitini geri koy
      array[i] = array[i] | highBit;
    }
    // array'in ilk elemanının en yüksek bitini son elemanın en düşük biti yap
    if (lastBit == 1) {
      array[0] = array[0] | 128;
    } else {
      array[0] = array[0] & 127;
    }
    return array;
  }
  bitShiftLeft(array) {
    // array'in ilk elemanının en yüksek bitini al
    let highBit = array[0] & 128;
    // array'in her elemanını sola doğru bir bit kaydır
    for (let i = 0; i < array.length; i++) {
      // elemanın en düşük bitini kaybetmemek için sakla
      let lowBit = array[i] & 1;
      // elemanı sola doğru bir bit kaydır
      array[i] = array[i] << 1;
      // elemanın en düşük bitini geri koy
      array[i] = array[i] | lowBit;
    }
    // array'in son elemanının en düşük bitini ilk elemanın en yüksek biti yap
    if (highBit == 128) {
      array[array.length - 1] = array[array.length - 1] | 1;
    } else {
      array[array.length - 1] = array[array.length - 1] & 254;
    }
    return array;
  }
  flipBits(array) {
    // array'in Uint8Array olduğunu kontrol et
    if (array instanceof Uint8Array) {
      // array'in başlangıç değerini göster

      // array'in her elemanını bit düzeyinde tersine çevir
      for (let i = 0; i < array.length; i++) {
        // elemanı ikili sayıya dönüştür
        let binary = array[i].toString(2);
        // ikili sayının başına eksik olan sıfırları ekle
        while (binary.length < 8) {
          binary = "0" + binary;
        }
        // ikili sayının her bitini tersine çevir
        let flipped = "";
        for (let j = 0; j < binary.length; j++) {
          if (binary[j] == "0") {
            flipped += "1";
          } else {
            flipped += "0";
          }
        }
        // tersine çevrilmiş ikili sayıyı ondalık sayıya dönüştür
        let decimal = parseInt(flipped, 2);
        // array'in elemanını değiştir
        array[i] = decimal;
      }

      // array'in son değerini göster
      return array;
    } else {
      // array Uint8Array değilse, hata mesajı verin
      console.log("Geçersiz girdi tipi");
    }
  }
  concatUint8Arrays(array1, array2) {
    // Birleştirilmiş dizinin boyutunu hesapla
    let size = array1.length + array2.length;
    // Birleştirilmiş diziyi oluştur
    let result = new Uint8Array(size);
    // Birinci diziyi kopyala
    for (let i = 0; i < array1.length; i++) {
      result[i] = array1[i];
    }
    // İkinci diziyi kopyala
    for (let i = 0; i < array2.length; i++) {
      result[i + array1.length] = array2[i];
    }
    // Birleştirilmiş diziyi döndür
    return result;
  }
  bitOR(data, key) {
    // key parametresinin tanımlı ve bir Uint8Array olduğunu kontrol et
    if (!key || !(key instanceof Uint8Array)) {
      throw new Error("Invalid key parameter");
    }
    // data parametresinin bir Uint8Array olduğunu kontrol et
    if (!(data instanceof Uint8Array)) {
      throw new Error("Invalid data parameter");
    }
    let result = new Uint8Array(data.byteLength);
    for (let i = 0; i < data.byteLength; i++) {
      result[i] = data[i] & key[i % key.length];
    }
    return result;
  }
  Uint8ArrayToBitString(uint8Array) {
    let bitString = "";
    for (let i = 0; i < uint8Array.length; i++) {
      // Her elemanı 8 bitlik ikili sayıya dönüştür
      let binary = uint8Array[i].toString(2).padStart(8, "0");
      // Bit string'e ekle
      bitString += binary;
    }
    return bitString;
  }
  BitStringToUint8Array(bitString) {
    // Bit string'i 8'er bitlik parçalara böl
    let chunks = bitString.match(/.{1,8}/g);
    // Her parçayı sayıya dönüştür ve Uint8Array'e ekle
    let uint8Array = new Uint8Array(chunks.length);
    for (let i = 0; i < chunks.length; i++) {
      uint8Array[i] = parseInt(chunks[i], 2);
    }
    return uint8Array;
  }
  keygen0(d,mode){
    if(Boolean(d)==false){
      return;
    }
    // var text = 'abcdefghjkloıuyt_';
    // console.log(this.md5(text));
    // console.log(text);
    // text = this.E_Shift(text,0);
    // text = this.D_Shift(text,0);
    // console.log(text);
    // console.log(this.md5(text));
    // this.checkCollisions();
    // this.findMissingChar();
    if(mode=="enc"){
      if (typeof d == 'string') {
        d = this.StringTouint8Array(d);
      }
    }
    var b = this.key;
    // var keylen = this.sumNumbers(b);
    var keylen = 1;
    var xlen = b.length;
    keylen = (xlen + keylen) % 9;
    if(keylen == 0) {
      keylen = 1;
    }
    var z = this.settingsgenerator(this.adler32(this.md5(b)));
    //if (j == true) {
    //    d = gzcompress (d, 9);
    //}
    //console.log(d);
    var _0xmap = [0x33, 0xfb, 0xa4, 0x90, 0x12, 0xcd, 0xef, 0x45, 0x67, 0x89, 0xab, 0xde, 0x01, 0x23, 0x45, 0x67, 0x89, 0xab, 0xcd, 0xef, 0x90, 0x12, 0x34, 0x56, 0x78, 0x9a, 0xbc, 0xde, 0xef, 0xfe, 0xdc, 0xba];
    var _1xmap = [0x24, 0x8d, 0x3f, 0x71, 0xa2, 0xb5, 0x60, 0x1c, 0xe9, 0xf7, 0x53, 0x2b, 0x6e, 0xd4, 0xc8, 0x9a, 0x17, 0x80, 0x6f, 0x5d, 0x47, 0x38, 0xae, 0x91, 0x4b, 0xd3, 0xc7, 0x0a, 0x12, 0xf5, 0x69, 0x33];
    var _2xmap = [0xa7, 0x2e, 0xf1, 0xd9, 0x8c, 0x50, 0x63, 0x91, 0x4b, 0x3d, 0x9f, 0x17, 0xe5, 0x8a, 0x37, 0x61, 0x29, 0x40, 0x7c, 0xbd, 0x52, 0xf8, 0xe0, 0xc6, 0xa3, 0x71, 0x06, 0x98, 0x24, 0x5f, 0x86, 0x3b];
    var _3xmap = [0x12,0x69,0xf9,0x45];
    var a1;
    var a = this.StringTouint8Array(Math.exp(Math.pow(keylen, b.length).toString()));
    for (var i = 0; i < 4; i++) {
      a = this.concatUint8Arrays(this.hex2bin(this.hash("sha512",this.key)),a);
      a1 = this.concatUint8Arrays(a,this.convert(_0xmap));
      a = this.XOREncrypt(this.concatUint8Arrays(this.concatUint8Arrays(this.fix(a),this.convert(_1xmap)),this.StringTouint8Array((Math.exp(Math.pow (2, 8))))), this.StringTouint8Array(Math.tan (Math.pow (2, 34)).toString()));
      a1 = this.bitShiftLeft(this.concatUint8Arrays(a,a1));
      a = this.Raw_hexrev (this.XOREncrypt(a,this.concatUint8Arrays(this.convert(_2xmap),this.StringTouint8Array(Math.exp (Math.pow (2, 10))))));
      a1 = this.bitShiftLeft(this.concatUint8Arrays(a,a1));
      a = this.XOREncrypt(a, this.concatUint8Arrays(this.base64_decode (this.hash0 + this.hash1 + this.hash2 + this.hash3 + this.hash4 + this.hash5 + this.hash6 + this.hash7 + this.hash8 + this.hash9 + this.hasha + this.hashb + this.hashc + this.hashd + this.hashe + this.hashf),this.Raw_hexrev (this.hex2bin(this.md5 (b + this.StringTouint8Array(Math.sin ((b.length % Math.exp (0.2)) / b.length) * Math.cos ((b.length % Math.exp (0.2)) / b.length) * Math.tan ((b.length % Math.exp (0.2)) / b.length)))))));
      a1 = this.bitShiftLeft(this.concatUint8Arrays(a,a1));
    }
    var c = this.numhash(b + this.hex2bin(this.sha1((this.hash("whirlpool", this.hex2bin(this.sha1 (a)))))), 1);
    var i;
    if(mode == "enc"){
      if(this.mode == "string"){
        if(this.blocksize==0 || this.blocksize<0){
          i = this.str_split(d,256);
        }else if(this.blocksize>128 && this.blocksize<=256){
          i = this.split_block(d,this.blocksize);
        }else{
          i = this.str_split(d,256);
        }
      }else{
        i = this.str_split(d,256);
      }
    }
    if(mode == "dec"){
      i = this.str_split(d,684);
    }
    a = this.hex2bin(this.hash("sha512",this.uint8ArrayToString(this.Raw_hexrev(this.concatUint8Arrays(this.concatUint8Arrays(this.base64_decode(this.hash0+this.hash1+this.hash2+this.hash3+this.hash4+this.hash5+this.hash6+this.hash7+this.hash8+this.hash9+this.hasha+this.hashb+this.hashc+this.hashd+this.hashe+this.hashf),this.convert(_3xmap)),this.StringTouint8Array(Math.exp(Math.pow(2,5))))))));
    a1 = this.bitShiftLeft(this.concatUint8Arrays(a,a1));
    a = this.uint8ArrayToString(a);
    if(c!=0){
      var ax=this.XOREncrypt(this.StringTouint8Array(a),this.CharCodeToUint8Array(this.salt_1_dat[c]));
      a=this.XOREncrypt(this.hex2bin(this.hash("sha512",b)),this.hex2bin(this.hash("sha512",this.StringTouint8Array(b)+this.uint8ArrayToString(ax))));
      b=this.hex2bin(this.Hex_Dont_Count(this.hash("sha512",b+this.uint8ArrayToString(a))));
    }else{
      b=this.hex2bin(this.Hex_Dont_Count(this.hash("sha512",b+a)));
    }
    var m = i.length;
    return [a,a1,b,z,i,keylen,c,m];
  }
  epart0(a,a1,b,f,keylen,k,m,c,h,g,e,ax,l,z,i){
    b = this.bitShiftRight(b);
    a1 = this.XOREncrypt(a1,b);
    f=this.Enc(l,a1,z,keylen);
    keylen++;
    if(keylen>8){
      keylen = 1;
    }
    if(k!=m){
    a=this.bitShiftRight(this.bitShiftLeft(this.XOREncrypt(this.hex2bin(this.hash("sha512",this.uint8ArrayToString(b))),this.hex2bin(this.hash("whirlpool",this.uint8ArrayToString(a)+this.uint8ArrayToString(this.swapPairs(this.CharCodeToUint8Array(this.salt_1_dat[h]))))))));
    c=this.numhash(b,1);
    if(c!=0){
        var ax=this.XOREncrypt(i[1],this.CharCodeToUint8Array(this.salt_1_dat[c]));
        a=this.bitShiftRight(this.bitShiftLeft(this.XOREncrypt(b,this.hex2bin(this.hash("sha512",this.uint8ArrayToString(b)+this.uint8ArrayToString(ax))))));
    }
    if(h==36){
        h=0;
    }
    a=this.bitShiftRight(this.bitShiftLeft(this.XOREncrypt(b,this.hex2bin(this.hash("sha512",this.hex2bin(f[1]))))));
    b=this.hex2bin(this.hash("sha512",this.strrev(a)+this.hash("sha512",this.base64_decode(this.hash0+this.hash1+this.hash2+this.hash3+this.hash4+this.hash5+this.hash6+this.hash7+this.hash8+this.hash9+this.hasha+this.hashb+this.hashc+this.hashd+this.hashe+this.hashf))+b+a+this.StringTouint8Array(this.substr(this.numhash(this.hex2bin(this.Hex_Dont_Count(this.hash("whirlpool",this.uint8ArrayToString(b)+this.uint8ArrayToString(a)+f[1]))),8),0,8))));
    a=this.bitShiftRight(this.bitShiftLeft(this.XOREncrypt(this.hex2bin(this.hash("sha512",this.uint8ArrayToString(b))),this.hex2bin(this.hash("whirlpool",this.uint8ArrayToString(a)+this.uint8ArrayToString(this.swapPairs(this.CharCodeToUint8Array(this.salt_st_dat[g]))))))));
    if(c!=0){
      var ax=this.XOREncrypt(i[0],this.CharCodeToUint8Array(this.salt_1_dat[c]));
      a=this.bitShiftRight(this.bitShiftLeft(this.XOREncrypt(b,this.hex2bin(this.hash("sha512",this.uint8ArrayToString(b)+this.uint8ArrayToString(ax))))));
    }
    if(g==36){
        g=0;
    }
    }
    e=e+f[0];
    k++;
    g++;
    h++;
    return [a,a1,b,f,keylen,k,m,c,h,g,e,ax,l,z,i];
  }
  dpart0(b,a1,i,keylen,l,n,c,ax,g,a,f,m,z,d,ixa1k,h){
    b = this.bitShiftRight(b);
    a1 = this.XOREncrypt(a1,b);
    i=this.Dec(m,a1,z,keylen);
    keylen++;
    if(keylen>8){
      keylen = 1;
    }
    if(l!=n){
    a=this.bitShiftRight(this.bitShiftLeft(this.XOREncrypt(this.hex2bin(this.hash("sha512",this.uint8ArrayToString(b))),this.hex2bin(this.hash("whirlpool",this.uint8ArrayToString(a)+this.uint8ArrayToString(this.swapPairs(this.CharCodeToUint8Array(this.salt_1_dat[g]))))))));
    c=this.numhash(b,1);
    if(c!=0){
        var ax=this.XOREncrypt(this.hex2bin(i[1]),this.CharCodeToUint8Array(this.salt_1_dat[c]));
        a=this.bitShiftRight(this.bitShiftLeft(this.XOREncrypt(b,this.hex2bin(this.hash("sha512",this.uint8ArrayToString(b)+this.uint8ArrayToString(ax))))));
    }
    if(g==36){
        g=0;
    }
    a=this.bitShiftRight(this.bitShiftLeft(this.XOREncrypt(b,this.hex2bin(this.hash("sha512",this.hex2bin(i[1]))))));
    b=this.hex2bin(this.hash("sha512",this.strrev(a)+this.hash("sha512",this.base64_decode(this.hash0+this.hash1+this.hash2+this.hash3+this.hash4+this.hash5+this.hash6+this.hash7+this.hash8+this.hash9+this.hasha+this.hashb+this.hashc+this.hashd+this.hashe+this.hashf))+b+a+this.StringTouint8Array(this.substr(this.numhash(this.hex2bin(this.Hex_Dont_Count(this.hash("whirlpool",this.uint8ArrayToString(b)+this.uint8ArrayToString(a)+i[1]))),8),0,8))));
    a=this.bitShiftRight(this.bitShiftLeft(this.XOREncrypt(this.hex2bin(this.hash("sha512",this.uint8ArrayToString(b))),this.hex2bin(this.hash("whirlpool",this.uint8ArrayToString(a)+this.uint8ArrayToString(this.swapPairs(this.CharCodeToUint8Array(this.salt_st_dat[f]))))))));
    if(c!=0){
        var ax=this.XOREncrypt(i[0],this.CharCodeToUint8Array(this.salt_st_dat[c]));
        a=this.bitShiftRight(this.bitShiftLeft(this.XOREncrypt(b,this.hex2bin(this.hash("sha512",this.uint8ArrayToString(b)+this.uint8ArrayToString(ax))))));
    }
    if(f==36){
        f=0;
    }
    }
    ixa1k++;
    if (h.length == 1) {
      // tek round
      d = i[0];
    } else {
      // birden fazla round
      if(ixa1k == h.length){
        d = d + i[0];
      }else{
        d = d + i[0] + ",";
      }
    }

    l++;
    f++;
    g++;
    return [b,a1,i,keylen,l,n,c,ax,g,a,f,m,z,d,ixa1k,h];
  }
  dend0(d){
    if (typeof d == "string") {
      var strArr2 = d.split(",");
      d = new Uint8Array(strArr2.length);
      for (var i = 0; i < strArr2.length; i++) { d[i] = parseInt(strArr2[i]); }
    }
    if(this.mode == "string" && this.blocksize != 0){
      d = this.removeEmptyBytes(d);
    }
    if(this.mode == "string"){
      d=this.uint8ArrayToString(d);
    }
    return d;
  }
  Encrypt (d) {
    try{
      var [[a,a1,b,z,i,keylen,c,m],[k,g,h],[ax,e,f]]=[this.keygen0(d,"enc"),[1,1,1],["","",""]];
      for(var l of i){
        [a,a1,b,f,keylen,k,m,c,h,g,e,ax,l,z,i] = this.epart0(a,a1,b,f,keylen,k,m,c,h,g,e,ax,l,z,i);
      }
      e+="==";
      return e;
    }catch(ex){
      div.remove();
      if(this.error==false){return "";}{
        throw new Error('Encrypt Error:'+ex);
      }
    }
  }
  Decrypt (e) {
    try{
      e = e.replace(/ /g, "").trim().replace(/=/g, "");
      var [[a,a1,b,z,h,keylen,c,n],[l,f,g],[d,ax,i],[ixa1k]] = [this.keygen0(e,"dec"),[1,1,1],["","",""],[0]];
      for(var m of h){
        [b,a1,i,keylen,l,n,c,ax,g,a,f,m,z,d,ixa1k,h] = this.dpart0(b,a1,i,keylen,l,n,c,ax,g,a,f,m,z,d,ixa1k,h);
      }
      d = this.dend0(d);
      return d;
    }catch(ex){
      div.remove();
      if(this.error==false){return "";}{
        throw new Error('Decrypt Error:'+ex);
      }
    }
  }
  Enc (f, c, z, keylen) {
      var g = c;
      g = this.hex2bin(this.Hex_Dont_Count (this.hash("sha512", g)));
      var j;
      if(this.mode == "string"){
        if(this.blocksize==0 || this.blocksize<0){
          j = this.str_split(f,128);
        }else if(this.blocksize<=128){
          j = this.split_block(f,this.blocksize);
        }else{
          j = this.str_split(f,128);
        }
      }else{
        j = this.str_split(f,128);
      }
      var d = "";
      var h = "";
      var e = 1;
      var ax = f.length;
      for (var k of j) {
        var a = this.Crypt (k, "e", c, keylen);
        if (ax > Math.pow (2, 7)) {
          var b = "";
          b = this.Eadd(this.CharCodeToUint8Array(this.salt_2_dat [e]),(keylen*2));
          var i = this.numhash(c, 1);
          if (i != 0) {
            b = this.Eadd(this.bitShiftRight(this.XOREncrypt(b, this.CharCodeToUint8Array(this.salt_2_dat[i]))),keylen);
          }
          if (e == 36) {
            e = 0;
          }
          e++;
          c = this.flipBits(this.hex2bin(this.Hex_Dont_Count (this.hash("sha512", this.XOREncrypt(this.strrev (this.XOREncrypt(c + this.convert(0xb5,0xb9), b)), a [1]) + b + a[1]))));
        }
        d = d + a[0];
        h = h + a[1];
      }
      a = "";
      var l = h;

      d = this.bk_kb(this.strrev (d));
      var _list = [];
      var _list1 = [];
      g = this.uint8ArrayToString(g);
      var g1 = g;
      for (var i = 0; i < (keylen + (this.digest % 32)); i++) {
        var g = this.uint8ArrayToString(this.hex2bin(CryptoJS.SHA512(g).toString()));
        var g1 = this.uint8ArrayToString(this.hex2bin(this.hash("whirlpool",g1)));
        _list.push(g);
        _list1.push(g1);
      }
      for (var i = 0; i < _list.length; i++) {
        d = this.E_Shift(this.E_d_round(d, z, _list[i]+_list1[i]),1);
        d = this.E_Shift(this.E_d_round(d, z, g+_list[i]+_list1[i]),0);
        d = this.E_Shift(this.E_d_round(d, z, _list[i]+"123"),2);
        d = this.E_Shift(this.E_d_round(d, z, _list1[i]+"123"),3);
      }
      return [d, l];
  }
  Dec (f, d, z, keylen) {
    var g = d;
      g = this.hex2bin(this.Hex_Dont_Count (this.hash("sha512", g)));
      g = this.uint8ArrayToString(g);
      var g1 = g;
      var a = f.trim ();
      var _list = [];
      var _list1 = [];
      for (var i = 0; i < (keylen + (this.digest % 32)); i++) {
        var g = this.uint8ArrayToString(this.hex2bin(CryptoJS.SHA512(g).toString()));
        var g1 = this.uint8ArrayToString(this.hex2bin(this.hash("whirlpool",g1)));
        _list.push(g);
        _list1.push(g1);
      }
      _list.reverse();
      _list1.reverse();
      for (var i = 0; i < _list.length; i++) {
        a = this.D_d_round(this.D_Shift(a,3), z, _list1[i]+"123");
        a = this.D_d_round(this.D_Shift(a,2), z, _list[i]+"123");
        a = this.D_d_round(this.D_Shift(a,0), z, g+_list[i]+_list1[i]);
        a = this.D_d_round(this.D_Shift(a,1), z, _list[i]+_list1[i]);
      }
      a = this.strrev (this.bk_kb(a));
      var j = this.str_split (a, 342);
      var ax = a.length;
      a = "";
      var h = "";
      var e = 1;
      var ixa1k = 0;
      for (var k of j) {
        var b = this.Crypt (k, "d", d, keylen);
        if (ax > Math.pow (2, 7)) {
          var c = "";
          c = this.Eadd(this.CharCodeToUint8Array(this.salt_2_dat[e]),(keylen*2));
          var i = this.numhash(d, 1);
          if (i != 0) {
            c = this.Eadd(this.bitShiftRight(this.XOREncrypt(c,this.CharCodeToUint8Array(this.salt_2_dat[i]))),keylen);
          }
          if(e==36){
            e=0;
          }
          e++;
          d=this.flipBits(this.hex2bin(this.Hex_Dont_Count(this.hash("sha512",this.XOREncrypt(this.strrev(this.XOREncrypt(d+this.convert(0xb5,0xb9),c)),b[1])+c+b[1]))));
        }
        ixa1k++;
        if (j.length == 1) {
          // tek round
          a=b[0];
        } else {
          // birden fazla round
          if(ixa1k == j.length){
            a=a+b[0];
          }else{
            a=a+b[0]+",";
          }
        }
        h=h+b[1];
      }
      
      b="";
      var l=h;
      return [a,l];
  }
  Crypt (r, x, f, keylen) {
    keylen += 2;
      var k = f;
      // var t = this.hex2bin(this.Hex_Dont_Count (this.hash("sha512", this.md5(k))));
      // f = this.Hex_Dont_Count (this.hash("sha512", f + t + this.convert(0x3f,0x6c,0x33) ));
      // var l = this.Raw_hexrev (this.hex2bin(this.Hex_Dont_Count (this.hash("sha512", f))));
      // var q = this.Raw_hexrev (this.hex2bin(this.Hex_Dont_Count (this.hash("whirlpool", this.uint8ArrayToString(this.hex2bin(this.E_hex_1 (f)))))));
      // var m = this.hex2bin(this.Hex_Dont_Count (this.hash("whirlpool", this.uint8ArrayToString(this.hex2bin(this.md5 (this.XOREncrypt(this.hex2bin(f), q)))))));
      // var g = this.hashtoXcode(f);
      // var o = this.hex2bin(this.Hex_Dont_Count (this.hash("sha512", this.uint8ArrayToString(this.Raw_hexrev (this.StringTouint8Array(Math.exp (Math.pow (2, 2))) + this.XOREncrypt(l, k))))));
      // var p = this.hex2bin(this.Hex_Dont_Count (this.hash("sha512", this.uint8ArrayToString(this.hex2bin(this.hash("whirlpool", q))))));
      var v,u,w,b,c;
      var _end_data;
      // Örnek bir k stringi ve bir n sayısı oluşturalım
      var k000 = this.uint8ArrayToString(k);
      let n000 = keylen + this.digest;
      // Fonksiyondan dönen key değerlerini alalım
      let keys000 = this.generateKeys(k000, n000);

      // Key değerlerinin sayısını alalım
      let keyCount = keys000.length;
      if (x == "e") {
        var a = "";
        _end_data = r;
        // Her bir key değeri için for döngüsü kullanalım
        for (let i000 = 0; i000 < keyCount; i000++) {
          // Key değerini bir değişkene atayalım
          let key000 = keys000[i000];
          //console.log("Round "+(i000+1));
          //console.log(keys000[i000]);
          // Key değerinin içindeki tüm elemanları konsola yazdıralım
          //console.log(key000[j000]);
          var t = key000[0];
          var f = key000[1];
          var l = key000[2];
          var q = key000[3];
          var m = key000[4];
          var g = key000[5];
          var o = key000[6];
          var p = key000[7];
          a = this.Raw_hexrev (_end_data);
          a = this.EaddX(a);
          a = this.swapPairs(a);
          a = this.shiftRight(a,64);
          a = this.Eadd(a,keylen);
          a = this.Eadd(a,36);
          a = this.BitStringToUint8Array(this.E_Shift(this.Uint8ArrayToBitString(a),3));
          a = this.hex2bin(this.Hex_Encrypt_Key (this.bin2hex (a), k));
          a = this.flipBits(a);
          a = this.Raw_hexrev(a);
          a = this.hex2bin(this.strtr (this.bin2hex (a), this.hex_char, this.change_5));
          a = this.hex2bin(this.E_hex_3 (this.bin2hex (a)));
          a = this.hex2bin(this.Hex_Encrypt_Key (this.bin2hex (a), p));
          a = this.Raw_hexrev (a);
          a = this.XOREncrypt(this.strrev (a), m);
          a = this.hex2bin(this.bin2hex(a).split('').map(function (char) {
            return this.hex_characters[this.change_a.indexOf(char)];
          }, this).join(''));
          a = this.hex2bin(this.bin2hex(a).split('').map(function (char) {
            return this.hex_characters[this.change_f.indexOf(char)];
          }, this).join(''));
          a = this.hex2bin(this.E_hex_1 (this.bin2hex (a)));
          a = this.hex2bin(this.Hex_Encrypt_Key (this.bin2hex (a), this.hex2bin(this.hash("whirlpool",this.uint8ArrayToString(this.concatUint8Arrays(this.bitOR(k,m),k))))));
          a = this.XOREncrypt(this.strrev (a), this.XOREncrypt(l,m));
          a = this.hex2bin(this.E_hex_2(this.bin2hex(a)));
          a = this.flipBits(a);
          a = this.Raw_hexrev(a);
          a = this.Eadd(a,12);
          a = this.hex2bin(this.Hex_Encrypt_Key(this.bin2hex(a),this.hex2bin(this.hash("whirlpool",this.uint8ArrayToString(this.concatUint8Arrays(this.bitOR(m,k),m))))));
          a = this.BitStringToUint8Array(this.E_Shift(this.Uint8ArrayToBitString(a),3));
          a = this.EaddX(a);
          a = this.shiftLeft(a,3);
          ////////////////////////
          if(i000==0){
            a = this.strrev(this.bin2hex(a));
            a = this.E_hex_1(a);
            var i=this.Hex_Dont_Count(this.bin2hex(this.openssl_random_pseudo_bytes(Math.pow(4,5)))).split("");
            var d=0;
            var e="";
            var j="";
            for(var h of a){
              
            if(d==Math.pow(2,7)){
                d=0;
                i=this.Hex_Dont_Count(this.bin2hex(this.openssl_random_pseudo_bytes(Math.pow(4,5))));
                f=this.Hex_Dont_Count(this.hash("sha512", this.concatUint8Arrays(this.concatUint8Arrays(this.hex2bin(f),t),this.convert(0x90, 0x12, 0x34, 0x56, 0x78, 0x9a, 0xbc, 0xde, 0xef, 0xfe, 0xdc, 0xba, 0x33, 0xfb, 0xa4, 0x90, 0x12, 0xcd, 0xef, 0x45, 0x67, 0x89, 0xab, 0xde, 0x01, 0x23, 0x45, 0x67, 0x89, 0xab, 0xcd, 0xef))));
                
                g=this.hashtoXcode(f);
            }
            if (g[d] == 0) {
              e = e + this.E_hex_1(h) + i[d];
              j = j + i[d];
            } else {
                if (g[d] == 1) {
                    e = e + i[d] + this.E_hex_2(h);
                    j = j + i[d];
                } else {
                    if (g[d] == 2) {
                        e = e + this.E_hex_1(h) + this.hashtohash_1(this.hashtohash_1(i[d]));
                        j = j + this.hashtohash_1(this.hashtohash_1(i[d]));
                    } else {
                        if (g[d] == 3) {
                            e = e + this.hashtohash_1(i[d]) + this.E_hex_2(h);
                            j = j + this.hashtohash_1(i[d]);
                        }
                    }
                }
            }
            d++;
            }
            var s = j;
            var n = "";
            var h = "";
            b = this.E_hex_1 (e);
            b = this.hex2bin(b);
          }else{
            b=a;
          }
          ////////////////////////
          b = this.Raw_hexrev(b);
          b = this.shiftLeft(b,2);
          b = this.flipBits(b);
          b = this.Eadd(b,64);
          b = this.BitStringToUint8Array(this.E_Shift(this.Uint8ArrayToBitString(b),2));
          b = this.hex2bin(this.E_Shift (this.bin2hex (b), 3));
          b = this.Eadd(b,8);
          b = this.hex2bin(this.Hex_Encrypt_Key (this.bin2hex (b), t));
          b = this.shiftRight(b,8);
          b = this.hex2bin(this.E_hex_2 (this.bin2hex (b)));
          b = this.hex2bin(this.Hex_Encrypt_Key (this.bin2hex (b), l));
          b = this.hex2bin(this.E_hex_1 (this.bin2hex (b)));
          b = this.hex2bin(this.Hex_Encrypt_Key (this.bin2hex (b), q));
          b = this.hex2bin(this.E_Shift(this.bin2hex(b), 1));
          b = this.hex2bin(this.E_hex_2(this.bin2hex(b)));
          b = this.hex2bin(this.E_Shift(this.bin2hex(b), 0));
          b = this.hex2bin(this.E_hex_1(this.bin2hex(b)));
          b = this.Raw_hexrev(b);
          b = this.Eadd(b,32);
          b = this.flipBits(b);
          b = this.XOREncrypt(this.strrev(b), o);
          b = this.hex2bin(this.E_Shift (this.bin2hex (b), 2));
          b = this.hex2bin(this.E_hex_3 (this.bin2hex (b)));
          b = this.XOREncrypt(this.strrev(b), l);
          b = this.hex2bin(this.E_Shift(this.bin2hex(b), 1));
          b = this.XOREncrypt(this.strrev(b), o); 
          b = this.hex2bin(this.E_hex_1(this.bin2hex(b))); 
          b = this.XOREncrypt(this.strrev(b), p);
          b = this.hex2bin(this.E_Shift(this.bin2hex(b), 0)); 
          b = this.hex2bin(this.E_hex_2(this.bin2hex(b)));
          b = this.flipBits(b);
          b = this.BitStringToUint8Array(this.E_Shift(this.Uint8ArrayToBitString(b),1));
          b = this.Eadd(b,8);
          b = this.shiftRight(b,12);
          b = this.EaddX(b);
          b = this.swapPairs(b);
          b = this.shiftRight(b,64);
          b = this.Eadd(b,keylen);
          b = this.Eadd(b,36);
          b = this.BitStringToUint8Array(this.E_Shift(this.Uint8ArrayToBitString(b),3));
          b = this.hex2bin(this.Hex_Encrypt_Key (this.bin2hex (b), k));
          b = this.flipBits(b);
          b = this.Raw_hexrev(b);
          b = this.hex2bin(this.strtr (this.bin2hex (b), this.hex_char, this.change_5));
          b = this.hex2bin(this.E_hex_3 (this.bin2hex (b)));
          b = this.hex2bin(this.Hex_Encrypt_Key (this.bin2hex (b), p));
          b = this.Raw_hexrev (b);
          b = this.XOREncrypt(this.strrev (b), m);
          b = this.hex2bin(this.bin2hex(b).split('').map(function (char) {
            return this.hex_characters[this.change_a.indexOf(char)];
          }, this).join(''));
          b = this.hex2bin(this.bin2hex(b).split('').map(function (char) {
            return this.hex_characters[this.change_f.indexOf(char)];
          }, this).join(''));
          b = this.hex2bin(this.E_hex_1 (this.bin2hex (b)));
          b = this.hex2bin(this.Hex_Encrypt_Key (this.bin2hex (b), this.hex2bin(this.hash("whirlpool",this.uint8ArrayToString(this.concatUint8Arrays(this.bitOR(k,m),k))))));
          b = this.XOREncrypt(this.strrev (b), this.XOREncrypt(l,m));
          b = this.hex2bin(this.E_hex_2(this.bin2hex(b)));
          b = this.flipBits(b);
          b = this.Raw_hexrev(b);
          b = this.Eadd(b,12);
          b = this.hex2bin(this.Hex_Encrypt_Key(this.bin2hex(b),this.hex2bin(this.hash("whirlpool",this.uint8ArrayToString(this.concatUint8Arrays(this.bitOR(m,k),m))))));
          b = this.BitStringToUint8Array(this.E_Shift(this.Uint8ArrayToBitString(b),3));
          b = this.EaddX(b);
          b = this.shiftLeft(b,3);
          _end_data = this.hex2bin(this.Hex_Encrypt_Key(this.bin2hex(b), k));
          s,b,a,j,e = "";
        }
        
        _end_data = this.E_rot13_1(this.bk_kb(this.base64_encode(_end_data).replace(/=/g, "")));
          v = _end_data;
      }if (x == "d") {
        keys000.reverse();
          r = r.trim();
          _end_data = r;
          _end_data = this.base64_decode(this.bk_kb(this.D_rot13_1(_end_data)));
          for (let i000 = 0; i000 < keyCount; i000++) {
            // Key değerini bir değişkene atayalım
            let key000 = keys000[i000];
            //console.log("Round "+(i000+1));
            //console.log(keys000[i000]);
            // Key değerinin içindeki tüm elemanları konsola yazdıralım
            //console.log(key000[j000]);
            var t = key000[0];
            var f = key000[1];
            var l = key000[2];
            var q = key000[3];
            var m = key000[4];
            var g = key000[5];
            var o = key000[6];
            var p = key000[7];
            a = this.hex2bin(this.Hex_Decrypt_Key(this.bin2hex(_end_data), k));
            a = this.shiftRight(a,3);
            a = this.DaddX(a);
            a = this.BitStringToUint8Array(this.D_Shift(this.Uint8ArrayToBitString(a),3));
            a = this.hex2bin(this.Hex_Decrypt_Key(this.bin2hex(a), this.hex2bin(this.hash("whirlpool",this.uint8ArrayToString(this.concatUint8Arrays(this.bitOR(m,k),m))))));
            a = this.Dadd(a,12);
            a = this.Raw_hexrev(a);
            a = this.flipBits(a);
            a = this.hex2bin(this.D_hex_2(this.bin2hex(a)));
            a = this.strrev(this.XORDecrypt(a, this.XOREncrypt(l, m)));
            a = this.hex2bin(this.Hex_Decrypt_Key(this.bin2hex(a), this.hex2bin(this.hash("whirlpool",this.uint8ArrayToString(this.concatUint8Arrays(this.bitOR(k,m),k))))));
            a = this.hex2bin(this.D_hex_1(this.bin2hex(a)));
            a = this.hex2bin(this.bin2hex(a).split('').map(function (char) {
              return this.change_f[this.hex_characters.indexOf(char)];
            }, this).join(''));
            a = this.hex2bin(this.bin2hex(a).split('').map(function (char) {
              return this.change_a[this.hex_characters.indexOf(char)];
            }, this).join(''));
            a = this.strrev(this.XORDecrypt(a, m));
            a = this.Raw_hexrev(a);
            a = this.hex2bin(this.Hex_Decrypt_Key(this.bin2hex(a), p));
            a = this.hex2bin(this.D_hex_3(this.bin2hex(a)));
            a = this.hex2bin(this.strtr(this.bin2hex(a), this.change_5, this.hex_char));
            a = this.Raw_hexrev(a);
            a = this.flipBits(a);
            a = this.hex2bin(this.Hex_Decrypt_Key(this.bin2hex(a), k));
            a = this.BitStringToUint8Array(this.D_Shift(this.Uint8ArrayToBitString(a),3));
            a = this.Dadd(a,36);
            a = this.Dadd(a,keylen);
            a = this.shiftLeft(a,64);
            a = this.swapPairs(a);
            a = this.DaddX(a);
            a = this.shiftLeft(a,12);
            a = this.Dadd(a,8);
            a = this.BitStringToUint8Array(this.D_Shift(this.Uint8ArrayToBitString(a),1));
            a = this.flipBits(a);
            a = this.hex2bin(this.D_hex_2(this.bin2hex(a)));
            a = this.hex2bin(this.D_Shift(this.bin2hex(a), 0));
            a = this.strrev(this.XORDecrypt(a, p));
            a = this.hex2bin(this.D_hex_1(this.bin2hex(a)));
            a = this.strrev(this.XORDecrypt(a, o));
            a = this.hex2bin(this.D_Shift(this.bin2hex(a), 1));
            a = this.strrev(this.XORDecrypt(a, l));
            a = this.hex2bin(this.D_hex_3(this.bin2hex(a)));
            a = this.hex2bin(this.D_Shift(this.bin2hex(a), 2));
            a = this.strrev(this.XORDecrypt(a, o));
            a = this.flipBits(a);
            a = this.Dadd(a,32);
            a = this.Raw_hexrev(a);
            a = this.hex2bin(this.D_hex_1(this.bin2hex(a)));
            a = this.hex2bin(this.D_Shift(this.bin2hex(a), 0));
            a = this.hex2bin(this.D_hex_2(this.bin2hex(a)));
            a = this.hex2bin(this.D_Shift(this.bin2hex(a), 1));
            a = this.hex2bin(this.Hex_Decrypt_Key(this.bin2hex(a), q));
            a = this.hex2bin(this.D_hex_1(this.bin2hex(a)));
            a = this.hex2bin(this.Hex_Decrypt_Key(this.bin2hex(a), l));
            a = this.hex2bin(this.D_hex_2(this.bin2hex(a)));
            a = this.shiftLeft(a,8);
            a = this.hex2bin(this.Hex_Decrypt_Key(this.bin2hex(a), t));
            a = this.Dadd(a,8);
            a = this.hex2bin(this.D_Shift(this.bin2hex(a), 3));
            a = this.BitStringToUint8Array(this.D_Shift(this.Uint8ArrayToBitString(a),2));
            a = this.Dadd(a,64);
            a = this.flipBits(a);
            a = this.shiftRight(a,2);
            a = this.Raw_hexrev(a);
            ///////////////////////////
            if (i000 === keyCount - 1) {
              a = this.bin2hex(a);
              a = this.D_hex_1(a);
              n = this.str_split(a, 2);
              e = "";
              d = 0;
              g = this.hashtoXcode(f);
              u = "";
              n.forEach((h) => {
              if (d == Math.pow(2, 7)) {
              d = 0;
              f = this.Hex_Dont_Count(this.hash("sha512", this.concatUint8Arrays(this.concatUint8Arrays(this.hex2bin(f),t),this.convert(0x90, 0x12, 0x34, 0x56, 0x78, 0x9a, 0xbc, 0xde, 0xef, 0xfe, 0xdc, 0xba, 0x33, 0xfb, 0xa4, 0x90, 0x12, 0xcd, 0xef, 0x45, 0x67, 0x89, 0xab, 0xde, 0x01, 0x23, 0x45, 0x67, 0x89, 0xab, 0xcd, 0xef))));
              g = this.hashtoXcode(f);
              }
              if (g[d] == 0 || g[d] == 2) {
                w = this.D_hex_1(this.substr(h, 0, 1));
                j = this.substr(h, -1, 1);
              }else if (g[d] == 1 || g[d] == 3) {
                w = this.D_hex_2(this.substr(h, -1, 1));
                j = this.substr(h, 0, 1);
              }
              d++;
              e = e + w;
              u = u + j;
              });
              s = u;
              n = "";
              h = "";
              e = this.D_hex_1(e);
              c = this.hex2bin(this.strrev(e));
            }else{
              c=a;
            }
            ///////////////////////////
            c = this.shiftRight(c,3);
            c = this.DaddX(c);
            c = this.BitStringToUint8Array(this.D_Shift(this.Uint8ArrayToBitString(c),3));
            c = this.hex2bin(this.Hex_Decrypt_Key(this.bin2hex(c), this.hex2bin(this.hash("whirlpool",this.uint8ArrayToString(this.concatUint8Arrays(this.bitOR(m,k),m))))));
            c = this.Dadd(c,12);
            c = this.Raw_hexrev(c);
            c = this.flipBits(c);
            c = this.hex2bin(this.D_hex_2(this.bin2hex(c)));
            c = this.strrev(this.XORDecrypt(c, this.XOREncrypt(l, m)));
            c = this.hex2bin(this.Hex_Decrypt_Key(this.bin2hex(c), this.hex2bin(this.hash("whirlpool",this.uint8ArrayToString(this.concatUint8Arrays(this.bitOR(k,m),k))))));
            c = this.hex2bin(this.D_hex_1(this.bin2hex(c)));
            c = this.hex2bin(this.bin2hex(c).split('').map(function (char) {
              return this.change_f[this.hex_characters.indexOf(char)];
            }, this).join(''));
            c = this.hex2bin(this.bin2hex(c).split('').map(function (char) {
              return this.change_a[this.hex_characters.indexOf(char)];
            }, this).join(''));
            c = this.strrev(this.XORDecrypt(c, m));
            c = this.Raw_hexrev(c);
            c = this.hex2bin(this.Hex_Decrypt_Key(this.bin2hex(c), p));
            c = this.hex2bin(this.D_hex_3(this.bin2hex(c)));
            c = this.hex2bin(this.strtr(this.bin2hex(c), this.change_5, this.hex_char));
            c = this.Raw_hexrev(c);
            c = this.flipBits(c);
            c = this.hex2bin(this.Hex_Decrypt_Key(this.bin2hex(c), k));
            c = this.BitStringToUint8Array(this.D_Shift(this.Uint8ArrayToBitString(c),3));
            c = this.Dadd(c,36);
            c = this.Dadd(c,keylen);
            c = this.shiftLeft(c,64);
            c = this.swapPairs(c);
            c = this.DaddX(c);
            _end_data = this.Raw_hexrev(c);
            c,e,u,w,j,g,a = "";
          }
          v = _end_data;
      }
      return [v, s];
  }
  unpack(format, data) {
    // check if data is a string or a Uint8Array
    if (typeof data === "string") {
      // convert the string to a Uint8Array
      var dataLength = data.length / 2; // the length of the Uint8Array is half the length of the hex string
      var dataUint8 = new Uint8Array(dataLength); // create a new Uint8Array with the data length
      for (var i = 0; i < dataLength; i++) {
        // get the hex value of each pair of characters in the data
        var hex = data.substring(i * 2, i * 2 + 2);
        // convert the hex value to a decimal value
        var dec = parseInt(hex, 16);
        // set the decimal value to the corresponding index in the Uint8Array
        dataUint8[i] = dec;
      }
      // use the Uint8Array as the data
      data = dataUint8;
    }
    else if (data instanceof Uint8Array) {
      // use the Uint8Array as it is
    }
    else {
      // throw an error if data is not a string or a Uint8Array
      throw new Error("Data must be a string or a Uint8Array");
    }
  
    // create an empty array to store the result
    var result = [];
    // get the format code and the repeat count from the format string
    var formatCode = format[0]; // the first character is the format code
    var repeatCount = parseInt(format.substring(1)); // the rest of the string is the repeat count
    // check if the format code is valid
    if (formatCode === "N" || formatCode === "V") {
      // N and V are for unsigned long (always 32 bit, big endian and little endian byte order)
      var byteCount = 4; // each unsigned long has 4 bytes
    }
    else {
      // throw an error if the format code is not valid
      throw new Error("Invalid format code: " + formatCode);
    }
    
    // loop through the data and unpack according to the format code and repeat count
    for (var i = 0; i < repeatCount; i++) {
      // get the bytes for the current value
      var bytes = data.slice(i * byteCount, (i + 1) * byteCount);
      // convert the bytes to a number according to the format code
      if (formatCode === "N") {
        // big endian byte order
        var number = 
          (bytes[0] << 24) + // first byte
          (bytes[1] << 16) + // second byte
          (bytes[2] << 8) + // third byte
          bytes[3]; // fourth byte
      }
      else if (formatCode === "V") {
        // little endian byte order
        var number = 
          bytes[0] + // first byte
          (bytes[1] << 8) + // second byte
          (bytes[2] << 16) + // third byte
          (bytes[3] << 24); // fourth byte
      }
      // push the number to the result array
      result.push(number);
    }
    
    // return the result array
    return result;
  }
  is_int(value) {
    // check if value is a number
    if (typeof value === "number") {
      // check if value is an integer
      if (Number.isInteger(value)) {
        // return true
        return true;
      }
      else {
        // return false
        return false;
      }
    }
    else {
      // return false
      return false;
    }
  }
  substring(string, start, length) {
    // check if string is a string
    if (typeof string === "string") {
      // check if start and length are integers
      if (this.is_int(start) && this.is_int(length)) {
        // check if start and length are valid
        if (start >= 0 && start < string.length && length > 0) {
          // get the substring using the slice method
          var substring = string.slice(start, start + length);
          // return the substring
          return substring;
        }
        else {
          // throw an error if start and length are invalid
          throw new Error("Invalid start or length value");
        }
      }
      else {
        // throw an error if start and length are not integers
        throw new Error("Start and length must be integers");
      }
    }
    else {
      // throw an error if string is not a string
      throw new Error("String must be a string");
    }
  }
  numhash(d,a=null){
    if (d instanceof Uint8Array) {
      var decoder = new TextDecoder();
      var d = decoder.decode(d);
    }
    var e = this.md5(d,true); // get the MD5 hash of d as a Uint8Array
    var c = this.unpack('N2',e); // unpack the first 8 bytes of e as two 32-bit unsigned integers
    var unsignedResult = c.map(x => x + Math.pow(2, 32));
    var b = "" + unsignedResult[0] + unsignedResult[1];
    if (a && this.is_int(a)){
      b = this.substr(b, 0, a); // get the first a digits of b using substring
    }
    return b; // return the result
  }
  Raw_hexrev(a){
    if (typeof a == "number") { var strNum = a.toString();
        // dizgeyi bir Uni8Array’e dönüştür 
        a = new Uint8Array(strNum.length); 
        // dizgenin her elemanını sayıya dönüştürerek Uni8Array’e atayın 
        for (var i = 0; i < strNum.length; i++) { a[i] = parseInt(strNum[i]); } } 
        // eğer girdi bir dizge ise, onu bir Uni8Array’e dönüştür 
    if (typeof a == "string") { 
        // dizgeyi virgüllere göre ayırarak bir dizi oluştur 
        var strArr = a.split(","); // bu diziyi bir Uni8Array’e dönüştür 
        a = new Uint8Array(strArr.length); 
        // dizinin her elemanını sayıya dönüştürerek Uni8Array’e atayın 
        for (var i = 0; i < strArr.length; i++) { a[i] = parseInt(strArr[i]); } 
    }
    a = this.bin2hex(a);
      var b = this.str_split(a,2);
      a = "";
      for (var c of b){
      a += this.strrev(c);
      }
      return this.hex2bin(a);
  }
  E_Shift(b, e) {
    try {
      // b string'inin uzunluğunu 4'e bölerek kalanı bul
      var remainder = b.length % 4;
      if(b.length<4){
        return b;
      }
  
      // Eğer kalan 0 ise
      if (remainder != 0) {
        var last_part = b.slice(-remainder);
      }
      if (e == 0) {
        if (remainder != 0) {
          var c = b.slice(0, -remainder).match(/.{1,4}/g);
        }else{
          var c = b.match(/.{1,4}/g);
        }
        b = "";
        for (var i = 0; i < c.length; i++) {
          if(i % 4 == 0){
            var a = c[i];
            var d = a[0] + a[1] + a[2] + a[3];
          }else if(i % 4 == 1){
            var a = c[i];
            var d = a[1] + a[2] + a[3] + a[0];
          }else if(i % 4 == 2){
            var a = c[i];
            var d = a[2] + a[3] + a[0] + a[1];
          }else{
            var a = c[i];
            var d = a[3] + a[0] + a[1] + a[2];
          }
          b += d;
        }
      } else if (e == 1) {
        if (remainder != 0) {
          var c = b.slice(0, -remainder).match(/.{1,4}/g);
        }else{
          var c = b.match(/.{1,4}/g);
        }
          b = "";
          for (var i = 0; i < c.length; i++) {
            if(i % 4 == 0){
              var a = c[i];
              var d = a[1] + a[2] + a[3] + a[0];
            }else if(i % 4 == 1){
              var a = c[i];
              var d = a[2] + a[3] + a[0] + a[1];
            }else if(i % 4 == 2){
              var a = c[i];
              var d = a[3] + a[0] + a[1] + a[2];
            }else{
              var a = c[i];
              var d = a[0] + a[1] + a[2] + a[3];
            }
            b += d;
          }
        } else if (e == 2) {
          if (remainder != 0) {
            var c = b.slice(0, -remainder).match(/.{1,4}/g);
          }else{
            var c = b.match(/.{1,4}/g);
          }
          b = "";
          for (var i = 0; i < c.length; i++) {
            if(i % 4 == 0){
              var a = c[i];
              var d = a[2] + a[3] + a[0] + a[1];
            }else if(i % 4 == 1){
              var a = c[i];
              var d = a[3] + a[0] + a[1] + a[2];
            }else if(i % 4 == 2){
              var a = c[i];
              var d = a[0] + a[1] + a[2] + a[3];
            }else{
              var a = c[i];
              var d = a[1] + a[2] + a[3] + a[0];
            }
            b += d;
          }
        } else if (e == 3) {
          if (remainder != 0) {
            var c = b.slice(0, -remainder).match(/.{1,4}/g);
          }else{
            var c = b.match(/.{1,4}/g);
          }
          b = "";
          for (var i = 0; i < c.length; i++) {
            if(i % 4 == 0){
              var a = c[i];
              var d = a[3] + a[0] + a[1] + a[2];
            }else if(i % 4 == 1){
              var a = c[i];
              var d = a[0] + a[1] + a[2] + a[3];
            }else if(i % 4 == 2){
              var a = c[i];
              var d = a[1] + a[2] + a[3] + a[0];
            }else{
              var a = c[i];
              var d = a[2] + a[3] + a[0] + a[1];
            }
            b += d;
          }
        }
      if(remainder != 0){
        b += last_part;
      }
      return b;
      
    } catch (e) {
      return b;
    }
  }
  D_Shift(b, e) {
    try {
      if(b.length<4){
        return b;
      }

      // b string'inin uzunluğunu 4'e bölerek kalanı bul
      var remainder = b.length % 4;
      if (remainder != 0) {
      var last_part = b.slice(-remainder);
      }
        // Bütün string'i 4'er bir şekilde işle
        if (e == 0) {
          if (remainder != 0) {
            var c = b.slice(0, -remainder).match(/.{1,4}/g);
          }else{
            var c = b.match(/.{1,4}/g);
          }
          b = "";
          for (var i = 0; i < c.length; i++) {
            if(i % 4 == 0){
              var a = c[i];
              var d = a[0] + a[1] + a[2] + a[3];
            }else if(i % 4 == 1){
              var a = c[i];
              var d = a[3] + a[0] + a[1] + a[2];
            }else if(i % 4 == 2){
              var a = c[i];
              var d = a[2] + a[3] + a[0] + a[1];
            }else{
              var a = c[i];
              var d = a[1] + a[2] + a[3] + a[0];
            }
            b += d;
          }
        } else if (e == 1) {
          if (remainder != 0) {
            var c = b.slice(0, -remainder).match(/.{1,4}/g);
          }else{
            var c = b.match(/.{1,4}/g);
          }
          b = "";
          for (var i = 0; i < c.length; i++) {
            if(i % 4 == 0){
              var a = c[i];
              var d = a[3] + a[0] + a[1] + a[2];
            }else if(i % 4 == 1){
              var a = c[i];
              var d = a[2] + a[3] + a[0] + a[1];
            }else if(i % 4 == 2){
              var a = c[i];
              var d = a[1] + a[2] + a[3] + a[0];
            }else{
              var a = c[i];
              var d = a[0] + a[1] + a[2] + a[3];
            }
            b += d;
          }
        } else if (e == 2) {
          if (remainder != 0) {
            var c = b.slice(0, -remainder).match(/.{1,4}/g);
          }else{
            var c = b.match(/.{1,4}/g);
          }
          b = "";
          for (var i = 0; i < c.length; i++) {
            if(i % 4 == 0){
              var a = c[i];
              var d = a[2] + a[3] + a[0] + a[1];
            }else if(i % 4 == 1){
              var a = c[i];
              var d = a[1] + a[2] + a[3] + a[0];
            }else if(i % 4 == 2){
              var a = c[i];
              var d = a[0] + a[1] + a[2] + a[3];
            }else{
              var a = c[i];
              var d = a[3] + a[0] + a[1] + a[2];
            }
            b += d;
          }
        } else if (e == 3) {
          if (remainder != 0) {
            var c = b.slice(0, -remainder).match(/.{1,4}/g);
          }else{
            var c = b.match(/.{1,4}/g);
          }
          b = "";
          for (var i = 0; i < c.length; i++) {
            if(i % 4 == 0){
              var a = c[i];
              var d = a[1] + a[2] + a[3] + a[0];
            }else if(i % 4 == 1){
              var a = c[i];
              var d = a[0] + a[1] + a[2] + a[3];
            }else if(i % 4 == 2){
              var a = c[i];
              var d = a[3] + a[0] + a[1] + a[2];
            }else{
              var a = c[i];
              var d = a[2] + a[3] + a[0] + a[1];
            }
            b += d;
          }
        }
      // Eğer kalan 0 değilse
      if (remainder != 0) {b += last_part;}
      return b;
      
    } catch (e) {
      return b;
    }
  }
  Hex_Dont_Count(a){
      a = a.trim().split("");
      var e = a.length;
      if (e == Math.pow(2,5)){
      var d = this.change_9;
      }else{
      if (e == Math.pow(2,6)){
      var d = this.change_2;
      }else{
      if (e == Math.pow(2,7)){
      var d = this.change_5;
      }else{
      var d = this.change_4;
      }
      }
      }
      for (var b = 0; b < e; b++){

      if (b+1 < e){
      if (a[b] == a[b+1]){
      if (a[b] == "a"){
      var c = a[b];
      a[b] = this.strtr(a[b],this.hex_char,this.change_a);
      if (a[b] == c){
      a[b] = this.strtr(a[b],this.hex_char,d);
      }
      }else{
      if (a[b] == "b"){
      var c = a[b];
      a[b] = this.strtr(a[b],this.hex_char,this.change_b);
      if (a[b] == c){
      a[b] = this.strtr(a[b],this.hex_char,d);
      }
      }else{
      if (a[b] == "c"){
      var c = a[b];
      a[b] = this.strtr(a[b],this.hex_char,this.change_c);
      if (a[b] == c){
      a[b] = this.strtr(a[b],this.hex_char,d);
      }
      }else{
      if (a[b] == "d"){
      var c = a[b];
      a[b] = this.strtr(a[b],this.hex_char,this.change_d);
      if (a[b] == c){
      a[b] = this.strtr(a[b],this.hex_char,d);
      }
      }else{
      if (a[b] == "e"){
      var c = a[b];
      a[b] = this.strtr(a[b],this.hex_char,this.change_e);
      if (a[b] == c){
      a[b] = this.strtr(a[b],this.hex_char,d);
      }
      }else{
      if (a[b] == "f"){
      var c = a[b];
      a[b] = this.strtr(a[b],this.hex_char,this.change_f);
      if (a[b] == c){
      a[b] = this.strtr(a[b],this.hex_char,d);
      }
      }else{
      if (a[b] == "0"){
      var c = a[b];
      a[b] = this.strtr(a[b],this.hex_char,this.change_0);
      if (a[b] == c){
      a[b] = this.strtr(a[b],this.hex_char,d);
      }
      }else{
      if (a[b] == "1"){
      var c = a[b];
      a[b] = this.strtr(a[b],this.hex_char,this.change_1);
      if (a[b] == c){
      a[b] = this.strtr(a[b],this.hex_char,d);
      }
      }else{
      if (a[b] == "2"){
      var c = a[b];
      a[b] = this.strtr(a[b],this.hex_char,this.change_2);
      if (a[b] == c){
      a[b] = this.strtr(a[b],this.hex_char,d);
      }
      }else{
      if (a[b] == "3"){
      var c = a[b];
      a[b]=this.strtr(a[b], this.hex_char , this.change_3 );
        if( a[b]==c ){
        a[b]=this.strtr(a[b], this.hex_char , d );
        }
        }else{
        if( a[b]=="4" ){
          var c=a[b];
          a[b]=this.strtr(a[b], this.hex_char , this.change_4 );
          if( a[b]==c ){
          a[b]=this.strtr(a[b], this.hex_char , d );
          }
        }else{
          if( a[b]=="5" ){
          var c=a[b];
          a[b]=this.strtr(a[b], this.hex_char , this.change_5 );
          if( a[b]==c ){
            a[b]=this.strtr(a[b], this.hex_char , d );
          }
          }else{
          if( a[b]=="6" ){
            var c=a[b];
            a[b]=this.strtr(a[b], this.hex_char , this.change_6 );
            if( a[b]==c ){
            a[b]=this.strtr(a[b], this.hex_char , d );
            }
          }else{
            if( a[b]=="7" ){
            var c=a[b];
            a[b]=this.strtr(a[b], this.hex_char , this.change_7 );
            if( a[b]==c ){
              a[b]=this.strtr(a[b], this.hex_char , d );
            }
            }else{
            if( a[b]=="8" ){
              var c=a[b];
              a[b]=this.strtr(a[b], this.hex_char , this.change_8 );
              if( a[b]==c ){
              a[b]=this.strtr(a[b], this.hex_char , d );
              }
            }else{
              if( a[b]=="9" ){
              var c=a[b];
              a[b]=this.strtr(a[b], this.hex_char , this.change_9 );
              if( a [ b ]==c ){
                a[b]=this.strtr( a[b], this.hex_char, d );
              }
              }
            }
            }
          }
          }
        }
        }
      }
      }
      }
      }
      }
      }
      }
      }
      }
      }
      }
      }
      return  a.join("");
  }
  XOREncrypt(data, key) {
      let result = new Uint8Array(data.byteLength);
      for (let i = 0; i < data.byteLength; i++) {
        result[i] = data[i] ^ key[i % key.length];
      }
      return result;
  } 
  XORDecrypt(data, key) {
      return this.XOREncrypt(data, key);
  }
  bk_kb(a) {
    let c = "";
    for (let b = 0; b <= a.length - 1; b++) {
      let d;
      if (a[b].toLowerCase() == a[b]) {
        d = "0";
      } else {
        if (a[b].toUpperCase() == a[b]) {
          d = "1";
        }
      }
      if (d == "1") {
        c = c + a[b].toLowerCase();
      } else {
        if (d == "0") {
          c = c + a[b].toUpperCase();
        }
      }
    }
    return c;
  }
  Hex_Encrypt_Key(a, c) {
    c = this.Hex_Dont_Count(this.md5(c));
    let d = 0;
    a = a.split("");
    for (let b = 0; b < a.length - 1; b++) {
      if (d == Math.pow(2, 5)) {
        d = 0;
        c = c.replace(this.hex_char, this.hashchan);
      }
      if (c[d] == "a") {
        a[b] = a[b].replace(this.hex_char, this.change_a);
      }
      if (c[d] == "b") {
        a[b] = a[b].replace(this.hex_char, this.change_b);
      }
      if (c[d] == "c") {
        a[b] = a[b].replace(this.hex_char, this.change_c);
      }
      if (c[d] == "d") {
        a[b] = a[b].replace(this.hex_char, this.change_d);
      }
      if (c[d] == "e") {
        a[b] = a[b].replace(this.hex_char, this.change_e);
      }
      if (c[d] == "f") {
        a[b] = a[b].replace(this.hex_char, this.change_f);
      }
      if (c[d] == "0") {
        a[b] = a[b].replace(this.hex_char, this.change_0);
      }
      if (c[d] == "1") {
        a[b] = a[b].replace(this.hex_char, this.change_1);
      }
      if (c[d] == "2") {
        a[b] = a[b].replace(this.hex_char, this.change_2);
      }
      if (c[d] == "3") {
        a[b] = a[b].replace(this.hex_char, this.change_3);
      }
      if (c[d] == "4") {
        a[b] = a[b].replace(this.hex_char, this.change_4);
      }
      if (c[d] == "5") {
        a[b] = a[b].replace(this.hex_char, this.change_5);
      }
      if (c[d] == "6") {
        a[b] = a[b].replace(this.hex_char, this.change_6);
      }
      if (c[d] == "7") {
        a[b] = a[b].replace(this.hex_char, this.change_7);
      }
      if (c[d] == "8") {
        a[b] = a[b].replace(this.hex_char, this.change_8);
      }
      if (c[d] == "9") {
        a[b] = a[b].replace(this.hex_char, this.change_9);
      }
      d++;
    }
    return a.join("");
  }
  Hex_Decrypt_Key(a, c) {
    c = this.Hex_Dont_Count(this.md5(c));
    let d = 0;
    a = a.split("");
    for (let b = 0; b < a.length - 1; b++) {
      if (d == Math.pow(2, 5)) {
        d = 0;
        c = c.replace(this.hex_char, this.hashchan);
      }
      if (c[d] == "a") {
        a[b] = a[b].replace(this.change_a, this.hex_char);
      }
      if (c[d] == "b") {
        a[b] = a[b].replace(this.change_b, this.hex_char);
      }
      if (c[d] == "c") {
        a[b] = a[b].replace(this.change_c, this.hex_char);
      }
      if (c[d] == "d") {
        a[b] = a[b].replace(this.change_d, this.hex_char);
      }
      if (c[d] == "e") {
        a[b] = a[b].replace(this.change_e, this.hex_char);
      }
      if (c[d] == "f") {
        a[b] = a[b].replace(this.change_f, this.hex_char);
      }
      if (c[d] == "0") {
        a[b] = a[b].replace(this.change_0, this.hex_char);
      }
      if (c[d] == "1") {
        a[b] = a[b].replace(this.change_1, this.hex_char);
      }
      if (c[d] == "2") {
        a[b] = a[b].replace(this.change_2, this.hex_char);
      }
      if (c[d] == "3") {
        a[b] = a[b].replace(this.change_3, this.hex_char);
      }
      if (c[d] == "4") {
        a[b] = a[b].replace(this.change_4, this.hex_char);
      }
      if (c[d] == "5") {
        a[b] = a[b].replace(this.change_5, this.hex_char);
      }
      if (c[d] == "6") {
        a[b] = a[b].replace(this.change_6, this.hex_char);
      }
      if (c[d] == "7") {
        a[b] = a[b].replace(this.change_7, this.hex_char);
      }
      if (c[d] == "8") {
        a[b] = a[b].replace(this.change_8, this.hex_char);
      }
      if (c[d] == "9") {
        a[b] = a[b].replace(this.change_9, this.hex_char);
      }
      d++;
    }
    return a.join("");
  }
  encrypt_key(c, a) {
    c = this.Hex_Dont_Count(this.md5(c));
    var d = 0;
    a = a.split("");
    for (var b = 0; b < a.length - 1; b++) {
      if (d == Math.pow(2, 5)) {
        d = 0;
        c = this.strtr(c, hex_char, hashchan1);
      }
  
      if (c[d] == "0") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hash0);
      } else if (c[d] == "1") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hash1);
      } else if (c[d] == "2") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hash2);
      } else if (c[d] == "3") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hash3);
      } else if (c[d] == "4") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hash4);
      } else if (c[d] == "5") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hash5);
      } else if (c[d] == "6") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hash6);
      } else if (c[d] == "7") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hash7);
      } else if (c[d] == "8") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hash8);
      } else if (c[d] == "9") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hash9);
      } else if (c[d] == "a") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hasha);
      } else if (c[d] == "b") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hashb);
      } else if (c[d] == "c") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hashc);
      } else if (c[d] == "d") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hashd);
      } else if (c[d] == "e") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hashe);
      } else if (c[d] == "f") {
        a[b] = this.strtr(a[b], this.base64_characters, this.hashf);
      }
  
      d++;
    }
    return a.join("");
  }
  decrypt_key(c, a) {
    c = this.Hex_Dont_Count(this.md5(c));
    var d = 0;
    a = a.split("");
    for (var b = 0; b < a.length - 1; b++) {
      if (d == Math.pow(2, 5)) {
        d = 0;
        c = this.strtr(c, this.hex_char, this.hashchan1);
      }
  
      if (c[d] == "0") {
        a[b] = this.strtr(a[b], this.hash0, this.base64_characters);
      } else if (c[d] == "1") {
        a[b] = this.strtr(a[b], this.hash1, this.base64_characters);
      } else if (c[d] == "2") {
        a[b] = this.strtr(a[b], this.hash2, this.base64_characters);
      } else if (c[d] == "3") {
        a[b] = this.strtr(a[b], this.hash3, this.base64_characters);
      } else if (c[d] == "4") {
        a[b] = this.strtr(a[b], this.hash4, this.base64_characters);
      } else if (c[d] == "5") {
        a[b] = this.strtr(a[b], this.hash5, this.base64_characters);
      } else if (c[d] == "6") {
        a[b] = this.strtr(a[b], this.hash6, this.base64_characters);
      } else if (c[d] == "7") {
        a[b] = this.strtr(a[b], this.hash7, this.base64_characters);
      } else if (c[d] == "8") {
        a[b] = this.strtr(a[b], this.hash8, this.base64_characters);
      } else if (c[d] == "9") {
        a[b] = this.strtr(a[b], this.hash9, this.base64_characters);
      } else if (c[d] == "a") {
        a[b] = this.strtr(a[b], this.hasha, this.base64_characters);
      } else if (c[d] == "b") {
        a[b] = this.strtr(a[b], this.hashb, this.base64_characters);
      } else if (c[d] == "c") {
        a[b] = this.strtr(a[b], this.hashc, this.base64_characters);
      } else if (c[d] == "d") {
        a[b] = this.strtr(a[b], this.hashd, this.base64_characters);
      } else if (c[d] == "e") {
        a[b] = this.strtr(a[b], this.hashe, this.base64_characters);
      } else if (c[d] == "f") {
        a[b] = this.strtr(a[b], this.hashf, this.base64_characters);
      }
  
      d++;
    }
    return a.join("");
  }
  encrypt_key(a, c) {
    a = CryptoJS.MD5(a).toString(CryptoJS.enc.Hex);
    let b = 0;
    let d = '';
    let e, hash;
    let result = '';
    for (e = 0; e <= c.length - 1; e++) {
    if (b == 32) {
    b = 0;
    a = CryptoJS.MD5(a).toString(CryptoJS.enc.Hex);
    }
    hash = this.Hash_Key(a.charAt(b), c.charAt(e));
    d = d + hash;
    b++;
    }
    result = d;
    return result;
  }
  decrypt_key(a, c) {
    a = CryptoJS.MD5(a).toString(CryptoJS.enc.Hex);
    let b = 0;
    let d = '';
    let e, hash;
    let result = '';
    for (e = 0; e <= c.length - 1; e++) {
    if (b == 32) {
    b = 0;
    a = CryptoJS.MD5(a).toString(CryptoJS.enc.Hex);
    }
    hash = this.Key_Hash(a.charAt(b), c.charAt(e));
    d = d + hash;
    b++;
    }
    result = d;
    return result;
  }
  E_d_round(a, c, d) {
    if(!typeof a == "string"){
      a = a.toString().split("").reverse().join("");
    }else{
      a = a.split("").reverse().join("");
    }
    
    let f = c.trim().toString().split("");
    let b, e, result;
    result = a;
    for (e = 0; e <= c.trim().length - 1; e++) {
    b = f[e];
    if (b == "E") {
    result = this.encrypt_key(d, result);
    }
    if (b == "1") {
    result = this.E_rot13_1(result);
    }
    if (b == "2") {
    result = this.E_rot13_2(result);
    }
    if (b == "3") {
    result = this.E_rot13_3(result);
    }
    if (b == "4") {
    result = this.E_rot13_4(result);
    }
    if (b == "C") {
    result = this.bk_kb(result);
    }
    }
    result = this.encrypt_key(d, result);
    return result;
  }
  D_d_round(a, c, d) {
    let f,e,b;
    a = this.decrypt_key(d, a);
    f = c.toString().split("").reverse();
    for (e = 0; e <= c.toString().split("").reverse().length - 1; e++) {
      b = f[e];
      if (b == "E") {
        a = this.decrypt_key(d, a);
      }
      if (b == "1") {
        a = this.D_rot13_1(a);
      }
      if (b == "2") {
        a = this.D_rot13_2(a);
      }
      if (b == "3") {
        a = this.D_rot13_3(a);
      }
      if (b == "4") {
        a = this.D_rot13_4(a);
      }
      if (b == "C") {
        a = this.bk_kb(a);
      }
    }
    a = a.toString().split("").reverse().join("");
    return a;
  }
  E_hex_1(a) {
    let d = a.split('').map(function (char) {
      return this.hex_1[this.hex_characters.indexOf(char)];
    }, this).join('');
    return d;
  }
  D_hex_1(a) {
    let d = a.split('').map(function (char) {
      return this.hex_characters[this.hex_1.indexOf(char)];
    }, this).join('');
    return d;
  }
  E_hex_2(a) {
    let d = a.split('').map(function (char) {
      return this.hex_2[this.hex_characters.indexOf(char)];
    }, this).join('');
    return d;
  }
  D_hex_2(a) {
    let d = a.split('').map(function (char) {
      return this.hex_characters[this.hex_2.indexOf(char)];
    }, this).join('');
    return d;
  }
  E_hex_3(a) {
    let d = a.split('').map(function (char) {
      return this.hex_3[this.hex_characters.indexOf(char)];
    }, this).join('');
    return d;
  }
  D_hex_3(a) {
    let d = a.split('').map(function (char) {
      return this.hex_characters[this.hex_3.indexOf(char)];
    }, this).join('');
    return d;
  }
  settingsgenerator(a) {
    let b,c,d;
    b = this.hex_characters;
    c = this.sg;
    d = a.toString().split("").map(function(x) {
      return c[b.indexOf(x)] || x;
    }).join("");
    return d;
  }
  settingsgenerator1(a) {
    let b,c,d;
    b = this.hex_characters;
    c = this.sg1;
    d = a.toString().split("").map(function(x) {
      return c[b.indexOf(x)] || x;
    }).join("");
    return d;
  }
  settingsgenerator2(a) {
    let b,c,d;
    b = this.hex_characters;
    c = this.sg2;
    d = a.toString().split("").map(function(x) {
      return c[b.indexOf(x)] || x;
    }).join("");
    return d;
  }
  hashtoXcode(a) {
    let b,c,d;
    b = this.hex_characters;
    c = this.hXc;
    d = a.toString().split("").map(function(x) {
      return c[b.indexOf(x)] || x;
    }).join("");
    return d;
  }
  hashtohash_1(a) {
    let b,c,d;
    b = this.hex_characters;
    c = this.hth_1;
    d = a.toString().split("").map(function(x) {
      return c[b.indexOf(x)] || x;
    }).join("");
    return d;
  }
  E_rot13_1(a) {
    let b = this.base64_characters;
    let c = this.rot13_1;
    let d = a.replace(/[A-Za-z0-9+/=]/g, m => c[b.indexOf(m)]);
    return d;
  }
  D_rot13_1(a) {
    let b = this.rot13_1;
    let c = this.base64_characters;
    let d = a.replace(/[A-Za-z0-9+/=]/g, m => c[b.indexOf(m)]);
    return d;
  }
  E_rot13_2(a) {
    const b = this.base64_characters;
    const c = this.rot13_2;
    const d = a.replace(/[A-Za-z0-9+/]/g, function(e) {
      return c.charAt(b.indexOf(e));
    });
    return d;
  }
  D_rot13_2(a) {
    const b = this.rot13_2;
    const c = this.base64_characters;
    const d = a.replace(/[A-Za-z0-9+/]/g, function(e) {
      return c.charAt(b.indexOf(e));
    });
    return d;
  }
  E_rot13_3(a) {
    const b = this.base64_characters;
    const c = this.rot13_3;
    const d = a.replace(/[A-Za-z0-9+/]/g, function(e) {
      return c.charAt(b.indexOf(e));
    });
    return d;
  }
  D_rot13_3(a) {
    const b = this.rot13_3;
    const c = this.base64_characters;
    const d = a.replace(/[A-Za-z0-9+/]/g, function(e) {
      return c.charAt(b.indexOf(e));
    });
    return d;
  }
  E_rot13_4(a) {
    const b = this.base64_characters;
    const c = this.rot13_4;
    const d = a.replace(/[A-Za-z0-9+/]/g, function(e) {
      return c.charAt(b.indexOf(e));
    });
    return d;
  }
  D_rot13_4(a) {
    const b = this.rot13_4;
    const c = this.base64_characters;
    const d = a.replace(/[A-Za-z0-9+/]/g, function(e) {
      return c.charAt(b.indexOf(e));
    });
    return d;
  }
  Hash_Key(b, c) {
    const d = this.base64_characters;
    let a;
    if (b === "0") {
      a = this.hash0;
    } else if (b === "1") {
      a = this.hash1;
    } else if (b === "2") {
      a = this.hash2;
    } else if (b === "3") {
      a = this.hash3;
    } else if (b === "4") {
      a = this.hash4;
    } else if (b === "5") {
      a = this.hash5;
    } else if (b === "6") {
      a = this.hash6;
    } else if (b === "7") {
      a = this.hash7;
    } else if (b === "8") {
      a = this.hash8;
    } else if (b === "9") {
      a = this.hash9;
    } else if (b === "a") {
      a = this.hasha;
    } else if (b === "b") {
      a = this.hashb;
    } else if (b === "c") {
      a = this.hashc;
    } else if (b === "d") {
      a = this.hashd;
    } else if (b === "e") {
      a = this.hashe;
    } else if (b === "f") {
      a = this.hashf;
    }
    const e = c.toString().split("").map(char => {
      const index = d.indexOf(char);
      return index !== -1 ? a[index] : char;
    }).join("");
    return e;
  }
  Key_Hash(b, c) {
    let a;
    if (b === "0") {
      a = this.hash0;
    } else if (b === "1") {
      a = this.hash1;
    } else if (b === "2") {
      a = this.hash2;
    } else if (b === "3") {
      a = this.hash3;
    } else if (b === "4") {
      a = this.hash4;
    } else if (b === "5") {
      a = this.hash5;
    } else if (b === "6") {
      a = this.hash6;
    } else if (b === "7") {
      a = this.hash7;
    } else if (b === "8") {
      a = this.hash8;
    } else if (b === "9") {
      a = this.hash9;
    } else if (b === "a") {
      a = this.hasha;
    } else if (b === "b") {
      a = this.hashb;
    } else if (b === "c") {
      a = this.hashc;
    } else if (b === "d") {
      a = this.hashd;
    } else if (b === "e") {
      a = this.hashe;
    } else if (b === "f") {
      a = this.hashf;
    }
    const d = this.base64_characters;
    const e = c.toString().split("").map(char => {
      const index = a.indexOf(char);
      return index !== -1 ? d[index] : char;
    }).join("");
    return e;
  }
// ! ||--------------------------------------------------------------------------------||
// ! ||                                    Dev Tools                                   ||
// ! ||--------------------------------------------------------------------------------||
  findMissingChar() { 
    let hashes = [this.rot13_1,this.rot13_2,this.rot13_3,this.rot13_4,this.hash0, this.hash1, this.hash2, this.hash3, this.hash4, this.hash5, this.hash6, this.hash7, this.hash8, this.hash9, this.hasha, this.hashb, this.hashc, this.hashd, this.hashe, this.hashf]; let chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+".split("");
    for (let i = 0; i < hashes.length; i++) { 
      for (let j = 0; j < hashes[i].length; j++) { 
        let index = hashes[i].indexOf(hashes[i][j], j + 1); 
        if (index !== -1) { 
          let charIndex = chars.indexOf(hashes[i][j]); 
          let missingChar = chars[(charIndex + 1) % chars.length]; 
          console.log("Eksik karakter: " + missingChar + " - " + i + ". hash’in " + j + ". ve " + index + ". karakterleri arasında"); 
        } 
      } 
    } 
  }
  checkCollisions() {  
  let hashNames = ["rot13_1","rot13_2","rot13_3","rot13_4","hash0", "hash1", "hash2", "hash3", "hash4", "hash5", "hash6", "hash7", "hash8", "hash9", "hasha", "hashb", "hashc", "hashd", "hashe", "hashf"]; let hashes = [this.rot13_1,this.rot13_2,this.rot13_3,this.rot13_4,this.hash0, this.hash1, this.hash2, this.hash3, this.hash4, this.hash5, this.hash6, this.hash7, this.hash8, this.hash9, this.hasha, this.hashb, this.hashc, this.hashd, this.hashe, this.hashf]; 
  let cakismasayisi = 0;
  for (let i = 0; i < hashes.length; i++) { 
    for (let j = 0; j < hashes[i].length; j++) { 
      for (let k = i + 1; k < hashes.length; k++) { 
        if (hashes[i][j] === hashes[k][j]) { cakismasayisi++; console.log("Çakışma: " + hashes[i][j] + " - " + hashNames[i] + ". hash’in " + j + ". karakteri ile " + hashNames[k] + ". hash’in " + j + ". karakteri"); } 
      }
    }
  } 
  console.log("Toplam "+cakismasayisi+" tane çakışma var.");
  }
  assignNumbers(md5Value) {
    var hexNumbers = {
      "0": 1,
      "1": 2,
      "2": 3,
      "3": 1,
      "4": 2,
      "5": 3,
      "6": 1,
      "7": 2,
      "8": 3,
      "9": 1,
      "a": 2,
      "b": 4,
      "c": 2,
      "d": 4,
      "e": 3,
      "f": 2
    };
    var result = "";
    for (var i = 0; i < md5Value.length; i++) {
        var char = md5Value[i]; // md5 değerindeki i. karakteri al
        var number = hexNumbers[char]; // bu karakteri hexNumbers objesindeki sayıya eşle
        result += number; // sonuç metnine ekle
    }
    return result;
  }
  sumNumbers(text) {
    var hash = this.md5(text); // metnin md5 karmasını hesapla
    var numbers = this.assignNumbers(hash); // md5 karmadaki her bir karaktere sayı ata
    var sum = 0; // toplamı tutacak değişken
    for (var i = 0; i < numbers.length; i++) {
        var digit = parseInt(numbers[i]); // sonuç metnindeki i. sayıyı al
        sum += digit; // toplama ekle
    }
    return sum;
  }
}


    //console.log("d");
    //console.log(d);
    //d = d.split(",").map((x) => parseInt(x));
    //d = new Uint8Array(d);
    //d = this.uint8ArrayToString(d);
    //if(j==true){
    //    d=gzuncompress(d);
    //}
    // string değeri virgüllere göre ayırarak bir dizi oluştur var strArr = "97,98,99".split(","); // bu diziyi bir Uni8Array’e dönüştür var u8a = new Uint8Array(strArr.length); // dizinin her elemanını sayıya dönüştürerek Uni8Array’e atayın for (var i = 0; i < strArr.length; i++) { u8a[i] = parseInt(strArr[i]); } // Uni8Array’i bir stringe dönüştürmek için String.fromCharCode fonksiyonunu kullanın var str = String.fromCharCode.apply(null, u8a); // sonucu yazdırın console.log(str); // "abc"






    // var keylen = this.sumNumbers(b);
    // var keylen = 1;
    // var xlen = b.length;
    // keylen = (xlen + keylen) % 9;
    // if(keylen == 0) {
    //   keylen = 1;
    // }
    // var z = this.settingsgenerator(this.adler32(this.md5(b)));
    // var k = b;
    // var _0xmap = [0x33, 0xfb, 0xa4, 0x90, 0x12, 0xcd, 0xef, 0x45, 0x67, 0x89, 0xab, 0xde, 0x01, 0x23, 0x45, 0x67, 0x89, 0xab, 0xcd, 0xef, 0x90, 0x12, 0x34, 0x56, 0x78, 0x9a, 0xbc, 0xde, 0xef, 0xfe, 0xdc, 0xba];
    // var _1xmap = [0x24, 0x8d, 0x3f, 0x71, 0xa2, 0xb5, 0x60, 0x1c, 0xe9, 0xf7, 0x53, 0x2b, 0x6e, 0xd4, 0xc8, 0x9a, 0x17, 0x80, 0x6f, 0x5d, 0x47, 0x38, 0xae, 0x91, 0x4b, 0xd3, 0xc7, 0x0a, 0x12, 0xf5, 0x69, 0x33];
    // var _2xmap = [0xa7, 0x2e, 0xf1, 0xd9, 0x8c, 0x50, 0x63, 0x91, 0x4b, 0x3d, 0x9f, 0x17, 0xe5, 0x8a, 0x37, 0x61, 0x29, 0x40, 0x7c, 0xbd, 0x52, 0xf8, 0xe0, 0xc6, 0xa3, 0x71, 0x06, 0x98, 0x24, 0x5f, 0x86, 0x3b];
    // var _3xmap = [0x12,0x69,0xf9,0x45];
    // var a1;
    // var a = this.StringTouint8Array(Math.exp(Math.pow(keylen, b.length).toString()));
    // for (var i = 0; i < 4; i++) {
    //   a = this.concatUint8Arrays(this.hex2bin(this.hash("sha512",this.key)),a);
    //   a1 = this.concatUint8Arrays(a,this.convert(_0xmap));
    //   a = this.XOREncrypt(this.concatUint8Arrays(this.concatUint8Arrays(this.fix(a),this.convert(_1xmap)),this.StringTouint8Array((Math.exp(Math.pow (2, 8))))), this.StringTouint8Array(Math.tan (Math.pow (2, 34)).toString()));
    //   a1 = this.bitShiftLeft(this.concatUint8Arrays(a,a1));
    //   a = this.Raw_hexrev (this.XOREncrypt(a,this.concatUint8Arrays(this.convert(_2xmap),this.StringTouint8Array(Math.exp (Math.pow (2, 10))))));
    //   a1 = this.bitShiftLeft(this.concatUint8Arrays(a,a1));
    //   a = this.XOREncrypt(a, this.concatUint8Arrays(this.base64_decode (this.hash0 + this.hash1 + this.hash2 + this.hash3 + this.hash4 + this.hash5 + this.hash6 + this.hash7 + this.hash8 + this.hash9 + this.hasha + this.hashb + this.hashc + this.hashd + this.hashe + this.hashf),this.Raw_hexrev (this.hex2bin(this.md5 (b + this.StringTouint8Array(Math.sin ((b.length % Math.exp (0.2)) / b.length) * Math.cos ((b.length % Math.exp (0.2)) / b.length) * Math.tan ((b.length % Math.exp (0.2)) / b.length)))))));
    //   a1 = this.bitShiftLeft(this.concatUint8Arrays(a,a1));
    // }
    // var c = this.numhash(b + this.hex2bin(this.sha1((this.hash("whirlpool", this.hex2bin(this.sha1 (a)))))), 1);
    // var h = this.str_split(e,684);
    // a = this.hex2bin(this.hash("sha512",this.uint8ArrayToString(this.Raw_hexrev(this.concatUint8Arrays(this.concatUint8Arrays(this.base64_decode(this.hash0+this.hash1+this.hash2+this.hash3+this.hash4+this.hash5+this.hash6+this.hash7+this.hash8+this.hash9+this.hasha+this.hashb+this.hashc+this.hashd+this.hashe+this.hashf),this.convert(_3xmap)),this.StringTouint8Array(Math.exp(Math.pow(2,5))))))));
    // a1 = this.bitShiftLeft(this.concatUint8Arrays(a,a1));
    // a = this.uint8ArrayToString(a);
    // if(c!=0){
    //   var ax=this.XOREncrypt(this.StringTouint8Array(a),this.CharCodeToUint8Array(this.salt_1_dat[c]));
    //   a=this.XOREncrypt(this.hex2bin(this.hash("sha512",k)),this.hex2bin(this.hash("sha512",this.StringTouint8Array(k)+this.uint8ArrayToString(ax))));
    //   b=this.hex2bin(this.Hex_Dont_Count(this.hash("sha512",b+this.uint8ArrayToString(a))));
    // }else{
    //   b=this.hex2bin(this.Hex_Dont_Count(this.hash("sha512",b+a)));
    // }
    // console.log(h);