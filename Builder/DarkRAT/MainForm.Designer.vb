<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()>
Partial Class MainForm
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()>
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()>
    Private Sub InitializeComponent()
        Me.components = New System.ComponentModel.Container()
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(MainForm))
        Me.RichTextBox1 = New System.Windows.Forms.RichTextBox()
        Me.CheckBox1 = New System.Windows.Forms.CheckBox()
        Me.Button1 = New System.Windows.Forms.Button()
        Me.Label1 = New System.Windows.Forms.Label()
        Me.NumericUpDown1 = New System.Windows.Forms.NumericUpDown()
        Me.ToolTip1 = New System.Windows.Forms.ToolTip(Me.components)
        Me.Label2 = New System.Windows.Forms.Label()
        Me.edkey = New System.Windows.Forms.TextBox()
        Me.Label3 = New System.Windows.Forms.Label()
        Me.gen_edkey = New System.Windows.Forms.Button()
        Me.Label5 = New System.Windows.Forms.Label()
        Me.visibility = New System.Windows.Forms.CheckBox()
        Me.crypt = New System.Windows.Forms.CheckBox()
        Me.BackgroundWorker1 = New System.ComponentModel.BackgroundWorker()
        Me.ProgressBar1 = New System.Windows.Forms.ProgressBar()
        Me.TabControl1 = New System.Windows.Forms.TabControl()
        Me.TabPage1 = New System.Windows.Forms.TabPage()
        Me.Label6 = New System.Windows.Forms.Label()
        Me.intervalMinute = New System.Windows.Forms.CheckBox()
        Me.intervalSecound = New System.Windows.Forms.CheckBox()
        Me.debug = New System.Windows.Forms.CheckBox()
        Me.TabPage3 = New System.Windows.Forms.TabPage()
        Me.Label9 = New System.Windows.Forms.Label()
        Me.Label8 = New System.Windows.Forms.Label()
        Me.Label7 = New System.Windows.Forms.Label()
        Me.Label11 = New System.Windows.Forms.Label()
        Me.Label10 = New System.Windows.Forms.Label()
        Me.Label4 = New System.Windows.Forms.Label()
        Me.PictureBox1 = New System.Windows.Forms.PictureBox()
        Me.spkey = New System.Windows.Forms.TextBox()
        Me.Label12 = New System.Windows.Forms.Label()
        CType(Me.NumericUpDown1, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.TabControl1.SuspendLayout()
        Me.TabPage1.SuspendLayout()
        Me.TabPage3.SuspendLayout()
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'RichTextBox1
        '
        Me.RichTextBox1.Anchor = CType((((System.Windows.Forms.AnchorStyles.Top Or System.Windows.Forms.AnchorStyles.Bottom) _
            Or System.Windows.Forms.AnchorStyles.Left) _
            Or System.Windows.Forms.AnchorStyles.Right), System.Windows.Forms.AnchorStyles)
        Me.RichTextBox1.BackColor = System.Drawing.Color.FromArgb(CType(CType(22, Byte), Integer), CType(CType(22, Byte), Integer), CType(CType(22, Byte), Integer))
        Me.RichTextBox1.ForeColor = System.Drawing.Color.DarkOrchid
        Me.RichTextBox1.Location = New System.Drawing.Point(16, 120)
        Me.RichTextBox1.Margin = New System.Windows.Forms.Padding(2)
        Me.RichTextBox1.Name = "RichTextBox1"
        Me.RichTextBox1.Size = New System.Drawing.Size(477, 382)
        Me.RichTextBox1.TabIndex = 0
        Me.RichTextBox1.Text = "https://pastebin.com/raw/9tthBC3X" & Global.Microsoft.VisualBasic.ChrW(10) & "https://pastebin.com/raw/th8AkCjJ"
        '
        'CheckBox1
        '
        Me.CheckBox1.AutoSize = True
        Me.CheckBox1.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.CheckBox1.Location = New System.Drawing.Point(499, 37)
        Me.CheckBox1.Margin = New System.Windows.Forms.Padding(2)
        Me.CheckBox1.Name = "CheckBox1"
        Me.CheckBox1.Size = New System.Drawing.Size(194, 17)
        Me.CheckBox1.TabIndex = 1
        Me.CheckBox1.Text = "Enable Startup (Not Recommended)"
        Me.ToolTip1.SetToolTip(Me.CheckBox1, "Download and execute all links when PC startup")
        Me.CheckBox1.UseVisualStyleBackColor = True
        '
        'Button1
        '
        Me.Button1.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.Button1.Location = New System.Drawing.Point(795, 477)
        Me.Button1.Margin = New System.Windows.Forms.Padding(2)
        Me.Button1.Name = "Button1"
        Me.Button1.Size = New System.Drawing.Size(121, 25)
        Me.Button1.TabIndex = 2
        Me.Button1.Text = ":: Build ::"
        Me.ToolTip1.SetToolTip(Me.Button1, "do you love me ?")
        Me.Button1.UseVisualStyleBackColor = True
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.Location = New System.Drawing.Point(497, 452)
        Me.Label1.Margin = New System.Windows.Forms.Padding(2, 0, 2, 0)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(88, 13)
        Me.Label1.TabIndex = 3
        Me.Label1.Text = "Request Interval:"
        '
        'NumericUpDown1
        '
        Me.NumericUpDown1.BackColor = System.Drawing.Color.FromArgb(CType(CType(22, Byte), Integer), CType(CType(22, Byte), Integer), CType(CType(22, Byte), Integer))
        Me.NumericUpDown1.ForeColor = System.Drawing.Color.Azure
        Me.NumericUpDown1.Location = New System.Drawing.Point(584, 449)
        Me.NumericUpDown1.Margin = New System.Windows.Forms.Padding(2)
        Me.NumericUpDown1.Minimum = New Decimal(New Integer() {1, 0, 0, 0})
        Me.NumericUpDown1.Name = "NumericUpDown1"
        Me.NumericUpDown1.Size = New System.Drawing.Size(47, 20)
        Me.NumericUpDown1.TabIndex = 4
        Me.NumericUpDown1.TextAlign = System.Windows.Forms.HorizontalAlignment.Center
        Me.ToolTip1.SetToolTip(Me.NumericUpDown1, "For better runtime, set value to 35")
        Me.NumericUpDown1.Value = New Decimal(New Integer() {5, 0, 0, 0})
        '
        'Label2
        '
        Me.Label2.AutoSize = True
        Me.Label2.Font = New System.Drawing.Font("TRON", 27.75!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label2.ForeColor = System.Drawing.Color.DarkOrchid
        Me.Label2.Location = New System.Drawing.Point(-1, -13)
        Me.Label2.Name = "Label2"
        Me.Label2.Size = New System.Drawing.Size(403, 67)
        Me.Label2.TabIndex = 5
        Me.Label2.Text = "Darkrat Builder"
        '
        'edkey
        '
        Me.edkey.Location = New System.Drawing.Point(17, 33)
        Me.edkey.Name = "edkey"
        Me.edkey.Size = New System.Drawing.Size(289, 20)
        Me.edkey.TabIndex = 7
        Me.edkey.Text = "otO3BA0&_YwGh5y966sfpW#mC_uIRMV#"
        '
        'Label3
        '
        Me.Label3.AutoSize = True
        Me.Label3.Location = New System.Drawing.Point(13, 15)
        Me.Label3.Name = "Label3"
        Me.Label3.Size = New System.Drawing.Size(229, 13)
        Me.Label3.TabIndex = 8
        Me.Label3.Text = "This key must be the same as in the config.php"
        '
        'gen_edkey
        '
        Me.gen_edkey.BackColor = System.Drawing.Color.Black
        Me.gen_edkey.Location = New System.Drawing.Point(310, 31)
        Me.gen_edkey.Margin = New System.Windows.Forms.Padding(0)
        Me.gen_edkey.Name = "gen_edkey"
        Me.gen_edkey.Size = New System.Drawing.Size(75, 23)
        Me.gen_edkey.TabIndex = 9
        Me.gen_edkey.Text = "Generate"
        Me.gen_edkey.UseVisualStyleBackColor = False
        '
        'Label5
        '
        Me.Label5.AutoSize = True
        Me.Label5.Location = New System.Drawing.Point(13, 105)
        Me.Label5.Name = "Label5"
        Me.Label5.Size = New System.Drawing.Size(150, 13)
        Me.Label5.TabIndex = 13
        Me.Label5.Text = "Here are your Raw addresses "
        '
        'visibility
        '
        Me.visibility.AutoSize = True
        Me.visibility.Checked = True
        Me.visibility.CheckState = System.Windows.Forms.CheckState.Checked
        Me.visibility.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.visibility.Location = New System.Drawing.Point(499, 15)
        Me.visibility.Margin = New System.Windows.Forms.Padding(2)
        Me.visibility.Name = "visibility"
        Me.visibility.Size = New System.Drawing.Size(45, 17)
        Me.visibility.TabIndex = 1
        Me.visibility.Text = "Hide"
        Me.visibility.UseVisualStyleBackColor = True
        '
        'crypt
        '
        Me.crypt.AutoSize = True
        Me.crypt.Checked = True
        Me.crypt.CheckState = System.Windows.Forms.CheckState.Checked
        Me.crypt.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.crypt.Location = New System.Drawing.Point(499, 60)
        Me.crypt.Margin = New System.Windows.Forms.Padding(2)
        Me.crypt.Name = "crypt"
        Me.crypt.Size = New System.Drawing.Size(113, 17)
        Me.crypt.TabIndex = 1
        Me.crypt.Text = "Extreme Obfuscate"
        Me.crypt.UseVisualStyleBackColor = True
        '
        'BackgroundWorker1
        '
        '
        'ProgressBar1
        '
        Me.ProgressBar1.Location = New System.Drawing.Point(498, 478)
        Me.ProgressBar1.Name = "ProgressBar1"
        Me.ProgressBar1.Size = New System.Drawing.Size(292, 23)
        Me.ProgressBar1.TabIndex = 15
        '
        'TabControl1
        '
        Me.TabControl1.Controls.Add(Me.TabPage1)
        Me.TabControl1.Controls.Add(Me.TabPage3)
        Me.TabControl1.ItemSize = New System.Drawing.Size(74, 18)
        Me.TabControl1.Location = New System.Drawing.Point(8, 57)
        Me.TabControl1.Name = "TabControl1"
        Me.TabControl1.SelectedIndex = 0
        Me.TabControl1.Size = New System.Drawing.Size(937, 536)
        Me.TabControl1.TabIndex = 16
        '
        'TabPage1
        '
        Me.TabPage1.BackColor = System.Drawing.Color.FromArgb(CType(CType(22, Byte), Integer), CType(CType(22, Byte), Integer), CType(CType(22, Byte), Integer))
        Me.TabPage1.Controls.Add(Me.Label12)
        Me.TabPage1.Controls.Add(Me.spkey)
        Me.TabPage1.Controls.Add(Me.Label6)
        Me.TabPage1.Controls.Add(Me.CheckBox1)
        Me.TabPage1.Controls.Add(Me.Label5)
        Me.TabPage1.Controls.Add(Me.ProgressBar1)
        Me.TabPage1.Controls.Add(Me.RichTextBox1)
        Me.TabPage1.Controls.Add(Me.visibility)
        Me.TabPage1.Controls.Add(Me.intervalMinute)
        Me.TabPage1.Controls.Add(Me.intervalSecound)
        Me.TabPage1.Controls.Add(Me.debug)
        Me.TabPage1.Controls.Add(Me.crypt)
        Me.TabPage1.Controls.Add(Me.edkey)
        Me.TabPage1.Controls.Add(Me.gen_edkey)
        Me.TabPage1.Controls.Add(Me.NumericUpDown1)
        Me.TabPage1.Controls.Add(Me.Label3)
        Me.TabPage1.Controls.Add(Me.Label1)
        Me.TabPage1.Controls.Add(Me.Button1)
        Me.TabPage1.Location = New System.Drawing.Point(4, 22)
        Me.TabPage1.Name = "TabPage1"
        Me.TabPage1.Padding = New System.Windows.Forms.Padding(3)
        Me.TabPage1.Size = New System.Drawing.Size(929, 510)
        Me.TabPage1.TabIndex = 0
        Me.TabPage1.Text = "Build Options"
        '
        'Label6
        '
        Me.Label6.AutoSize = True
        Me.Label6.Location = New System.Drawing.Point(698, 39)
        Me.Label6.Name = "Label6"
        Me.Label6.Size = New System.Drawing.Size(218, 13)
        Me.Label6.TabIndex = 16
        Me.Label6.Text = "to Startup your Payload use DarkRATLoader"
        '
        'intervalMinute
        '
        Me.intervalMinute.AutoSize = True
        Me.intervalMinute.Checked = True
        Me.intervalMinute.CheckState = System.Windows.Forms.CheckState.Checked
        Me.intervalMinute.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.intervalMinute.Location = New System.Drawing.Point(645, 450)
        Me.intervalMinute.Margin = New System.Windows.Forms.Padding(2)
        Me.intervalMinute.Name = "intervalMinute"
        Me.intervalMinute.Size = New System.Drawing.Size(60, 17)
        Me.intervalMinute.TabIndex = 1
        Me.intervalMinute.Text = "Minutes"
        Me.intervalMinute.UseVisualStyleBackColor = True
        '
        'intervalSecound
        '
        Me.intervalSecound.AutoSize = True
        Me.intervalSecound.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.intervalSecound.Location = New System.Drawing.Point(719, 450)
        Me.intervalSecound.Margin = New System.Windows.Forms.Padding(2)
        Me.intervalSecound.Name = "intervalSecound"
        Me.intervalSecound.Size = New System.Drawing.Size(71, 17)
        Me.intervalSecound.TabIndex = 1
        Me.intervalSecound.Text = "Secounds"
        Me.intervalSecound.UseVisualStyleBackColor = True
        '
        'debug
        '
        Me.debug.AutoSize = True
        Me.debug.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.debug.Location = New System.Drawing.Point(499, 83)
        Me.debug.Margin = New System.Windows.Forms.Padding(2)
        Me.debug.Name = "debug"
        Me.debug.Size = New System.Drawing.Size(154, 17)
        Me.debug.TabIndex = 1
        Me.debug.Text = " Debug Function Removed "
        Me.debug.UseVisualStyleBackColor = True
        '
        'TabPage3
        '
        Me.TabPage3.BackColor = System.Drawing.Color.FromArgb(CType(CType(22, Byte), Integer), CType(CType(22, Byte), Integer), CType(CType(22, Byte), Integer))
        Me.TabPage3.Controls.Add(Me.Label9)
        Me.TabPage3.Controls.Add(Me.Label8)
        Me.TabPage3.Controls.Add(Me.Label7)
        Me.TabPage3.Controls.Add(Me.Label11)
        Me.TabPage3.Controls.Add(Me.Label10)
        Me.TabPage3.Controls.Add(Me.Label4)
        Me.TabPage3.Controls.Add(Me.PictureBox1)
        Me.TabPage3.Location = New System.Drawing.Point(4, 22)
        Me.TabPage3.Name = "TabPage3"
        Me.TabPage3.Size = New System.Drawing.Size(929, 510)
        Me.TabPage3.TabIndex = 2
        Me.TabPage3.Text = "Credits"
        '
        'Label9
        '
        Me.Label9.AutoSize = True
        Me.Label9.Location = New System.Drawing.Point(523, 149)
        Me.Label9.Name = "Label9"
        Me.Label9.Size = New System.Drawing.Size(63, 13)
        Me.Label9.TabIndex = 1
        Me.Label9.Text = "NYANxCAT"
        '
        'Label8
        '
        Me.Label8.AutoSize = True
        Me.Label8.Location = New System.Drawing.Point(523, 168)
        Me.Label8.Name = "Label8"
        Me.Label8.Size = New System.Drawing.Size(51, 13)
        Me.Label8.TabIndex = 1
        Me.Label8.Text = "Leetware"
        '
        'Label7
        '
        Me.Label7.AutoSize = True
        Me.Label7.Font = New System.Drawing.Font("Montserrat", 8.249999!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label7.Location = New System.Drawing.Point(523, 131)
        Me.Label7.Name = "Label7"
        Me.Label7.Size = New System.Drawing.Size(124, 14)
        Me.Label7.TabIndex = 1
        Me.Label7.Text = "Special Thanks to:"
        '
        'Label11
        '
        Me.Label11.AutoSize = True
        Me.Label11.Font = New System.Drawing.Font("Montserrat", 8.249999!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label11.Location = New System.Drawing.Point(523, 86)
        Me.Label11.Name = "Label11"
        Me.Label11.Size = New System.Drawing.Size(174, 14)
        Me.Label11.TabIndex = 1
        Me.Label11.Text = "Type: Http Botnet Builder"
        '
        'Label10
        '
        Me.Label10.AutoSize = True
        Me.Label10.Font = New System.Drawing.Font("Montserrat", 8.249999!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label10.Location = New System.Drawing.Point(523, 60)
        Me.Label10.Name = "Label10"
        Me.Label10.Size = New System.Drawing.Size(82, 14)
        Me.Label10.TabIndex = 1
        Me.Label10.Text = "Version: 0.1"
        '
        'Label4
        '
        Me.Label4.AutoSize = True
        Me.Label4.Font = New System.Drawing.Font("Montserrat", 8.249999!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label4.Location = New System.Drawing.Point(523, 37)
        Me.Label4.Name = "Label4"
        Me.Label4.Size = New System.Drawing.Size(133, 14)
        Me.Label4.TabIndex = 1
        Me.Label4.Text = "Creator: DarkSpider"
        '
        'PictureBox1
        '
        Me.PictureBox1.BackgroundImage = Global.Builder_custom.My.Resources.Resources._387242_PCG4D0_13
        Me.PictureBox1.Location = New System.Drawing.Point(0, 6)
        Me.PictureBox1.Name = "PictureBox1"
        Me.PictureBox1.Size = New System.Drawing.Size(504, 525)
        Me.PictureBox1.TabIndex = 0
        Me.PictureBox1.TabStop = False
        '
        'spkey
        '
        Me.spkey.Location = New System.Drawing.Point(16, 76)
        Me.spkey.Name = "spkey"
        Me.spkey.Size = New System.Drawing.Size(289, 20)
        Me.spkey.TabIndex = 17
        '
        'Label12
        '
        Me.Label12.AutoSize = True
        Me.Label12.Location = New System.Drawing.Point(14, 60)
        Me.Label12.Name = "Label12"
        Me.Label12.Size = New System.Drawing.Size(67, 13)
        Me.Label12.TabIndex = 18
        Me.Label12.Text = "Spreaded by"
        '
        'MainForm
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackColor = System.Drawing.Color.FromArgb(CType(CType(22, Byte), Integer), CType(CType(22, Byte), Integer), CType(CType(22, Byte), Integer))
        Me.ClientSize = New System.Drawing.Size(957, 605)
        Me.Controls.Add(Me.TabControl1)
        Me.Controls.Add(Me.Label2)
        Me.ForeColor = System.Drawing.Color.Azure
        Me.Icon = CType(resources.GetObject("$this.Icon"), System.Drawing.Icon)
        Me.Margin = New System.Windows.Forms.Padding(2)
        Me.Name = "MainForm"
        Me.Opacity = 0.95R
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen
        Me.Text = "DarkRat Builder V 1.1.1"
        CType(Me.NumericUpDown1, System.ComponentModel.ISupportInitialize).EndInit()
        Me.TabControl1.ResumeLayout(False)
        Me.TabPage1.ResumeLayout(False)
        Me.TabPage1.PerformLayout()
        Me.TabPage3.ResumeLayout(False)
        Me.TabPage3.PerformLayout()
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub

    Friend WithEvents RichTextBox1 As RichTextBox
    Friend WithEvents CheckBox1 As CheckBox
    Friend WithEvents Button1 As Button
    Friend WithEvents Label1 As Label
    Friend WithEvents NumericUpDown1 As NumericUpDown
    Friend WithEvents ToolTip1 As ToolTip
    Friend WithEvents Label2 As Label
    Friend WithEvents edkey As TextBox
    Friend WithEvents Label3 As Label
    Friend WithEvents gen_edkey As Button
    Friend WithEvents Label5 As Label
    Friend WithEvents visibility As CheckBox
    Friend WithEvents crypt As CheckBox
    Friend WithEvents BackgroundWorker1 As System.ComponentModel.BackgroundWorker
    Friend WithEvents ProgressBar1 As ProgressBar
    Friend WithEvents TabControl1 As TabControl
    Friend WithEvents TabPage1 As TabPage
    Friend WithEvents TabPage3 As TabPage
    Friend WithEvents PictureBox1 As PictureBox
    Friend WithEvents Label9 As Label
    Friend WithEvents Label8 As Label
    Friend WithEvents Label7 As Label
    Friend WithEvents Label10 As Label
    Friend WithEvents Label4 As Label
    Friend WithEvents Label11 As Label
    Friend WithEvents debug As CheckBox
    Friend WithEvents intervalMinute As CheckBox
    Friend WithEvents intervalSecound As CheckBox
    Friend WithEvents Label6 As Label
    Friend WithEvents spkey As TextBox
    Friend WithEvents Label12 As Label
End Class
