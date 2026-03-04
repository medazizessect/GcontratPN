VERSION 5.00

Begin VB.Form FArrondissement
    Caption = "C?IC??E"
    ScaleMode = 1
    AutoRedraw = 0              'False
    FontTransparent = -1              'True
    BorderStyle = 1
    LinkTopic = "Form1"
    MaxButton = 0              'False
    MinButton = 0              'False
    ClientLeft   = 45
    ClientTop    = 330
    ClientWidth  = 5535
    ClientHeight = 1395
    RightToLeft = -1              'True
    StartupPosition = 2
    Begin VB.CommandButton Command11
        Left   = 120
        Top    = 840
        Width  = 375
        Height = 375
        TabIndex = 8
        Picture = FArrondissement.frx:0000
        Style = 1
    End
    Begin VB.CommandButton Command10
        Left   = 480
        Top    = 840
        Width  = 375
        Height = 375
        TabIndex = 7
        Picture = FArrondissement.frx:03E6
        Style = 1
    End
    Begin VB.CommandButton Command9
        Left   = 840
        Top    = 840
        Width  = 375
        Height = 375
        TabIndex = 6
        Picture = FArrondissement.frx:07D8
        Style = 1
    End
    Begin VB.CommandButton Command8
        Left   = 1320
        Top    = 840
        Width  = 375
        Height = 375
        TabIndex = 5
        Picture = FArrondissement.frx:0B72
        Style = 1
    End
    Begin VB.CommandButton Command1
        Caption = "IUUUUU???"
        Left   = 120
        Top    = 120
        Width  = 1455
        Height = 375
        TabIndex = 4
    End
    Begin VB.Frame Frame1
        Caption = "C?IC??E"
        Left   = 1680
        Top    = 240
        Width  = 3735
        Height = 660
        TabIndex = 2
        RightToLeft = -1              'True
        Begin VB.TextBox Text1
            Left   = 120
            Top    = 240
            Width  = 3495
            Height = 285
            TabIndex = 3
            Alignment = 1
            MaxLength = 50
            DataField = "LibArr"
            RightToLeft = -1              'True
        End
    End
    Begin VB.TextBox Text2
        Left   = 2040
        Top    = 960
        Width  = 735
        Height = 285
        Visible = 0              'False
        Text = "Text2"
        TabIndex = 1
        DataField = "CodeArr"
    End
    Begin VB.CommandButton Command2
        Caption = "?UUU?C?UUU?"
        Left   = 120
        Top    = 840
        Width  = 1455
        Height = 375
        TabIndex = 0
    End
End
