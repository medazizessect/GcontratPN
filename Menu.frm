VERSION 5.00
Object = "{00025600-0000-0000-C000-000000000046}#5.2#0"; "C:\WINDOWS\SysWow64\Crystl32.OCX"
Object = "{831FDD16-0C5C-11D2-A9FC-0000F8754DA1}#2.0#0"; "C:\Program Files (x86)\VBReFormer\Lib\MSCOMCTL.OCX"

Begin VB.MDIForm Menu
    BackColor = -2147483636
    WindowState = 2
    LinkTopic = "MDIForm1"
    ClientLeft   = 60
    ClientTop    = 630
    ClientWidth  = 6660
    ClientHeight = 5880
    RightToLeft = -1              'True
    StartupPosition = 2
    Begin VB.Timer Timer1
        Interval = 1000
        Left = 960
        Top = 8040
    End
    Begin Crystal.CrystalReport CRT1
        OleObjectBlob = Menu.frx:0000
        Left = 3000
        Top = 3360
    End
    Begin VB.PictureBox Picture1
        Left   = 4635
        Top    = 870
        Width  = 2025
        Height = 4635
        TabIndex = 0
        ScaleMode = 1
        AutoRedraw = 0              'False
        FontTransparent = -1              'True
        Align = 4
        RightToLeft = -1              'True
        Begin VB.CommandButton Command5
            Left   = 70
            Top    = 8040
            Width  = 1860
            Height = 350
            Enabled = 0              'False
            TabIndex = 7
        End
        Begin VB.CommandButton Command3
            Caption = "?UUUEUUUUC?UUUUUUE"
            Left   = 70
            Top    = 1320
            Width  = 1860
            Height = 350
            Enabled = 0              'False
            TabIndex = 6
        End
        Begin VB.CommandButton Command2
            Caption = "C?UUEUU?CEUUE"
            Left   = 70
            Top    = 960
            Width  = 1860
            Height = 350
            TabIndex = 4
        End
        Begin VB.CommandButton Command1
            Caption = "???CE ??IC??"
            Left   = 70
            Top    = 600
            Width  = 1860
            Height = 350
            TabIndex = 3
        End
        Begin VB.CommandButton Command4
            Caption = "?I?CE"
            Left   = 70
            Top    = 7680
            Width  = 1860
            Height = 350
            Enabled = 0              'False
            TabIndex = 2
        End
        Begin VB.CommandButton Command6
            Left   = 70
            Top    = 8400
            Width  = 1860
            Height = 350
            Enabled = 0              'False
            TabIndex = 1
        End
        Begin MSComctlLib.ListView ListView1
            Left   = 75
            Top    = 1680
            Width  = 1860
            Height = 6005
            TabIndex = 5
            OleObjectBlob = Menu.frx:0000
        End
        Begin MSComctlLib.ImageList ImageList2
            OleObjectBlob = Menu.frx:0000
            Left = 0
            Top = 1200
        End
    End
    Begin MSComctlLib.Toolbar Toolbar1
        Left   = 0
        Top    = 0
        Width  = 6660
        Height = 870
        TabIndex = 8
        OleObjectBlob = Menu.frx:0000
        Align = 1
        Begin MSComctlLib.ImageList ImageList1
            OleObjectBlob = Menu.frx:0000
            Left = 11280
            Top = 120
        End
    End
    Begin MSComctlLib.StatusBar StatusBar1
        Left   = 0
        Top    = 5505
        Width  = 6660
        Height = 375
        TabIndex = 9
        OleObjectBlob = Menu.frx:0000
        Align = 2
    End
    Begin VB.Menu dossier
        Caption = "&C?E?CEE"
        Begin VB.Menu Societe
            Caption = "??O?E C????CE"
        End
        Begin VB.Menu Personnel
            Caption = "???C? C????CE"
        End
        Begin VB.Menu esp1
            Caption = "-"
        End
        Begin VB.Menu Quit
            Caption = "&I???"
        End
    End
    Begin VB.Menu stat
        Caption = "&???C??CE"
    End
    Begin VB.Menu Outil
        Caption = "&?I?CE"
        Begin VB.Menu verdos
            Caption = "C?EEEE ?? C????CE"
        End
    End
    Begin VB.Menu info
        Caption = "&?"
    End
End
