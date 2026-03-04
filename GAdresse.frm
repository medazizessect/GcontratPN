VERSION 5.00
Object = "{00025600-0000-0000-C000-000000000046}#5.2#0"; "C:\WINDOWS\SysWow64\Crystl32.OCX"
Object = "{CDE57A40-8B86-11D0-B3C6-00A0C90AEA82}#1.0#0"; "C:\WINDOWS\SysWow64\MSDATGRD.OCX"

Begin VB.Form GAdresse
    Caption = "C????C?"
    WindowState = 2
    ScaleMode = 1
    AutoRedraw = 0              'False
    FontTransparent = -1              'True
    BorderStyle = 1
    LinkTopic = "Form1"
    MDIChild = -1              'True
    ClientLeft   = 45
    ClientTop    = 330
    ClientWidth  = 6060
    ClientHeight = 6765
    RightToLeft = -1              'True
    Begin Crystal.CrystalReport CRT1
        OleObjectBlob = GAdresse.frx:0000
        Left = 6720
        Top = 2280
    End
    Begin MSDataGridLib.DataGrid DataGrid1
        Left   = 120
        Top    = 120
        Width  = 6135
        Height = 9015
        TabIndex = 0
        OleObjectBlob = GAdresse.frx:0000
        Bindings = [UNPREDICTABLE]
    End
End
