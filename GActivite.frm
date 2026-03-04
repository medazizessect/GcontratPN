VERSION 5.00
Object = "{CDE57A40-8B86-11D0-B3C6-00A0C90AEA82}#1.0#0"; "C:\WINDOWS\SysWow64\MSDATGRD.OCX"

Begin VB.Form GActivite
    Caption = "C???C??"
    WindowState = 2
    ScaleMode = 1
    AutoRedraw = 0              'False
    FontTransparent = -1              'True
    LinkTopic = "Form1"
    MDIChild = -1              'True
    ClientLeft   = 60
    ClientTop    = 345
    ClientWidth  = 3585
    ClientHeight = 6705
    RightToLeft = -1              'True
    Begin MSDataGridLib.DataGrid DataGrid1
        Left   = 0
        Top    = 0
        Width  = 5820
        Height = 9375
        TabIndex = 0
        OleObjectBlob = GActivite.frx:0000
        Bindings = [UNPREDICTABLE]
    End
End
