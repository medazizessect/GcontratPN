VERSION 5.00
Object = "{CDE57A40-8B86-11D0-B3C6-00A0C90AEA82}#1.0#0"; "C:\WINDOWS\SysWow64\MSDATGRD.OCX"

Begin VB.Form CFiche
    ScaleMode = 1
    AutoRedraw = 0              'False
    FontTransparent = -1              'True
    BorderStyle = 1
    LinkTopic = "Form1"
    MaxButton = 0              'False
    MinButton = 0              'False
    ClientLeft   = 45
    ClientTop    = 330
    ClientWidth  = 13185
    ClientHeight = 8985
    RightToLeft = -1              'True
    StartupPosition = 2
    Begin VB.CommandButton Command1
        Caption = "EUUU?UUUUE"
        Left   = 3840
        Top    = 240
        Width  = 1575
        Height = 855
        TabIndex = 2
        RightToLeft = -1              'True
        Picture = CFiche.frx:0000
        Style = 1
    End
    Begin VB.Frame Frame3
        Caption = "C???? ?C???E"
        Left   = 5520
        Top    = 120
        Width  = 4455
        Height = 1020
        TabIndex = 0
        RightToLeft = -1              'True
        Begin VB.TextBox Text1
            Left   = 120
            Top    = 360
            Width  = 4215
            Height = 405
            TabIndex = 1
            Alignment = 1
            MaxLength = 50
            RightToLeft = -1              'True
        End
    End
    Begin MSDataGridLib.DataGrid DataGrid1
        Left   = 120
        Top    = 1320
        Width  = 12825
        Height = 7455
        TabIndex = 3
        OleObjectBlob = CFiche.frx:08DE
    End
End
