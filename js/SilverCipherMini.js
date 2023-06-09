class SilverCipherMini {
    constructor(key) {
      this.hex_characters="abcdef0123456789";
      this.base64_characters="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
      this.hex_1="549e30c67ba2f81d";
      this.sg="C1C2C3C4E1324412";
      this.hXc="0201110202211102";
      this.hth_1="61fa2bed734890c5";
      this.rot13_1="4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";
      this.rot13_2="wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";
      this.rot13_3="h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";
      this.rot13_4="JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";
      this.hash0="Lp2P/9DC+w7FeRto6nmOzjbcEQrTMhUZGiyS1f8xJaWYHNX3klsu0KAIVvB4qg5d";
      this.hash1="752IFzi6SPaXrQsNYtwERHLUZCTO9xjmJclq1KuAknW0VD4gMbBGyv38/fehpo+d";
      this.hash2="4zhwZkgPMG87lHRAaXK5uv0SFT9ycI6nEem/NJiVf2qY+jQsUWbtxo3LpDrOCBd1";
      this.hash3="p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";
      this.hash4="HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";
      this.hash5="fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";
      this.hash6="mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";
      this.hash7="EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";
      this.hash8="opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";
      this.hash9="mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";
      this.hasha="VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";
      this.hashb="08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";
      this.hashc="D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";
      this.hashd="3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";
      this.hashe="hRa4QoBy5blILAusSC/YFXKr6qpfP9c2N13TUvtZJxGWw0e+DOM7z8idVjgHEmkn";
      this.hashf="fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
      if (key === null || key === undefined) {
        this.key = "123456789";
      } else {
        this.key = key;
      }
    }
   base64_encode(array) {
      var base64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
      var result = '';
      var i, j, triplet;
    
      for (i = 0; i < array.length; i += 3) {
        triplet = (array[i] << 16) | (array[i + 1] << 8) | array[i + 2];
        for (j = 0; j < 4; j += 1) {
          if (i * 8 + j * 6 <= array.length * 8) {
            result += base64.charAt((triplet >> 18 - j * 6) & 0x3F);
          } else {
            result += '==';
          }
        }
      }
      return result.replace(/=*$/, '');
    }
     base64_decode(str) {
      const lookup = { '+': 62, '/': 63 };
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
      
      return ((b << 16) | a).toString(16).padStart(8, '0');
    }
    uint8ArrayToString(uint8Array) {
      return new TextDecoder().decode(uint8Array);
    }
    StringTouint8Array(str) {
      return new TextEncoder().encode(str);
    }
    hex2bin(hexString) {
      var length = hexString.length / 2;
      var uint8Array = new Uint8Array(length);
      for (let i = 0; i < length; ++i) {
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
    Encrypt(e) {
      let a = this.key;
      let f = this.settingsgenerator(this.adler32(a).toString(CryptoJS.enc.Hex));
      let g = e.match(/.{1,256}/g);
      let b="";
      let c="";
      var aHash = CryptoJS.SHA512(a).toString(CryptoJS.enc.Hex);
      g.forEach((h) => {
        c = this.Enc(h, aHash, f);
        aHash = CryptoJS.SHA512(aHash + c[1]).toString(CryptoJS.enc.Hex);
        b = b + c[0] + ":";
      });
    
      b = b.substring(0, b.length - 1);
      return b;
    }
    Decrypt(f) {
      let a = this.key;
      let g = this.settingsgenerator(this.adler32(a).toString(CryptoJS.enc.Hex));
      let b = f.toString().split(":");
      let c = "";
      let i = b.length;
      var d="";
      a = CryptoJS.SHA512(a).toString(CryptoJS.enc.Hex);
      for (var j = 0; j < i; j++) {
        d = this.Dec(b[j], a, g);
        a = CryptoJS.SHA512(a + d[1]).toString(CryptoJS.enc.Hex);
        c += d[0];
      }
      return c;
  }
   Enc(f, b, g) {
      let c = b;
      var h = f.match(/.{1,128}/g);
      let a = '';
      let e = '';
      for (let i = 0; i < h.length; i++) {
        var d = this.FlushX(h[i], "e", b);
        b = CryptoJS.SHA512(b).toString(CryptoJS.enc.Hex);
        a += d[0] + ".";
        e += d[1];
      }
      var j = e;
      c = CryptoJS.SHA512(c).toString(CryptoJS.enc.Hex);
      a = this.E_death_round(a.slice(0, -1), g, c);
      a = a.toString().split('').reverse().join('');
      return [a, j];
    }
    Dec(e, b, f) {
      var a = e.trim();
      a = a.toString().split('').reverse().join('');
      var g = CryptoJS.SHA512(b).toString(CryptoJS.enc.Hex);
      a = this.D_death_round(a, f, g);
      var h = a.toString().split(".");
      a = '';
      var d='';
      for (let i = 0; i < h.length; i++) {
        var c = this.FlushX(h[i], "d", b);
        b = CryptoJS.SHA512(b).toString(CryptoJS.enc.Hex);
        a += c[0];
        d += c[1];
      }
      var j = d;
      return [a, j];
    }
     FlushX(n, v, d) {
      var t='';
      var q = this.StringTouint8Array(d);
      var b;
      d = CryptoJS.SHA512(d).toString(CryptoJS.enc.Hex);
      var k = this.hex2bin(d);
      var p = this.hex2bin(this.E_hex_1(d));
      var m = this.XOREncrypt(k, p);
      var g = this.hashtoXcode(d);
      
      if (v == "e") {
        n = this.StringTouint8Array(n);
        var b = this.XOREncrypt(n, m);
        b = this.XOREncrypt(b, this.XOREncrypt(k, m));
        b = this.bin2hex(b);
        for (var o = 1; o <= 10; o++) {
          b = this.E_hex_1(b);
        }
        var i = d;
        var a = 0;
        var c = '';
        var l = b.toString().split("");
        var h = '';
        Array.from(l).forEach(function(f) {
          if (a == 128) {
            a = 0;
            i = d;
            d = CryptoJS.SHA512(d).toString(CryptoJS.enc.Hex);
            g = this.hashtoXcode(d.toString());
          }
          if (g[a] == 0) {
            c = c + this.E_hex_1(f.toString()) + i[a].toString();
            h = h + i[a];
          } else if (g[a] == 1) {
            c = c + i[a] + this.E_hex_1(f.toString());
            h = h + i[a];
          } else if (g[a] == 2) {
            c = c + this.E_hex_1(f.toString()) + this.hashtohash_1(i[a].toString());
            h = h + this.hashtohash_1(i[a].toString());
          }
          a++;
        }, this);
        var s = h;
        var l = '';
        var f = '';
        c = this.E_hex_1(c);
        var e = this.hex2bin(c);
        e = this.XOREncrypt(e, this.XOREncrypt(k, q));
        e = this.XOREncrypt(e, k);
        j='';
        j = this.base64_encode(e);
        var t = j.replace(/=/g, '');
      }else {
          if (v === "d") {
            n = n.trim();
            c = n;
            b = this.base64_decode(c);
            b = this.XORDecrypt(b, k);
            b = this.XORDecrypt(b, this.XOREncrypt(k, q));
            e = this.bin2hex(b);
            e = this.D_hex_1(e);
            l=[];
            for (let i = 0; i < e.length; i+=2) {
              l.push(e.substring(i, i+2));
            }
            var c = '';
            var u = '';
            a = 0;
            g = this.hashtoXcode(d.toString());
            var r = '';
            Array.from(l).forEach(function(f) {
              if (a === 128) {
                a = 0;
                d = CryptoJS.SHA512(d).toString(CryptoJS.enc.Hex);
                g = this.hashtoXcode(d.toString());
              }
              if (g[a] == 0 || g[a] == 2) {
                u = this.D_hex_1(f.substr(0, 1));
                h = f.substr(-1, 1);
              } else if (g[a] == 1) {
                u = this.D_hex_1(f.substr(-1, 1));
                h = f.substr(0, 1).toString();
              }
              a++;
              c += u;
              r += h;
            },this);
            s = r;
            l = '';
            f = '';
            for (let o = 1; o <= 10; o++) {
              c = this.D_hex_1(c.toString());
            }
            var j='';
            j = this.hex2bin(c);
            j = this.XORDecrypt(j, this.XOREncrypt(k, m));
            j = this.XORDecrypt(j, m);
            if (j === "") {
              exit;
            }
            j=this.uint8ArrayToString(j);
            var t = j;
          }
        }
        return [t, s];
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
       bk_kb(a) {
          let c = '';
          let b, d;
          for (b = 0; b <= a.length - 1; b++) {
          if (a.charAt(b).toLowerCase() == a.charAt(b)) {
          d = "0";
          }
          if (a.charAt(b).toUpperCase() == a.charAt(b)) {
          d = "1";
          }
          if (d == "1") {
          c = c + a.charAt(b).toLowerCase();
          } else {
          if (d == "0") {
          c = c + a.charAt(b).toUpperCase();
          }
          }
          }
          return c;
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
       E_death_round(a, c, d) {
          a = a.toString().split("").reverse().join("");
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
       D_death_round(a, c, d) {
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
         settingsgenerator(a) {
          let b,c,d;
          b = this.hex_characters;
          c = this.sg;
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
          const b = this.base64_characters;
          const c = this.rot13_1;
          const d = a.replace(/[A-Za-z0-9+/]/g, function(e) {
            return c.charAt(b.indexOf(e));
          });
          return d;
        }
         D_rot13_1(a) {
          const b = this.rot13_1;
          const c = this.base64_characters;
          const d = a.replace(/[A-Za-z0-9+/]/g, function(e) {
            return c.charAt(b.indexOf(e));
          });
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
  }